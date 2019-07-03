<style lang="scss" scoped>
</style>
<template>
  <!-- Main Container -->
  <main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
      <div class="content content-full">
        <div
          class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center"
        >
          <h1 class="flex-sm-fill h3 my-2">
            Chuyến du lịch
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            >Thêm chuyến du lịch</small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Quản lý</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Chuyến du lịch</a>
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <!-- END Hero -->
    <form>
      <!-- Page Content -->
      <div class="content">
        <!-- Full Table -->
        <div class="block">
          <div class="block-header">
            <h3 class="block-title">1. Thông tin tuyến du lịch</h3>
          </div>
          <div class="block-content block-content-full">
            <div class="row">
              <div class="col-md-12">
                <div class="form-row">
                  <div class="form-group col-6">
                    <label for>
                      Chuyến du lịch
                      <span class="text-danger">*</span>
                    </label>
                    <v-select
                      v-model="form.tour_tourist_route"
                      name="tour_tourist_route"
                      :class="{ 'is-invalid': form.errors.has('tour_tourist_route') }"
                      required
                      :filterable="false"
                      @search="onSearchTouristRoute"
                      :options="touristRoutes"
                      label="tr_name"
                    ></v-select>
                    <has-error :form="form" field="tour_tourist_route"></has-error>
                  </div>
                  <div class="form-group col-6">
                    <label for>
                      Khuyến mãi
                      <span class="text-danger">*</span>
                    </label>
                    <v-select
                      v-model="form.tour_promotion"
                      name="tour_promotion"
                      :class="{ 'is-invalid': form.errors.has('tour_promotion') }"
                      :filterable="false"
                      @search="onSearchPromotion"
                      :options="promotions"
                      label="prom_name"
                    ></v-select>
                    <has-error :form="form" field="tour_promotion"></has-error>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <!-- Full Table -->
        <div class="block">
          <div class="block-header">
            <h3 class="block-title">2. Lịch xếp tour</h3>
          </div>
          <div class="block-content block-content-full">
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
                <v-date-picker
                  locale="vi-VN"
                  mode="multiple"
                  v-model="form.dates"
                  :masks="{ data: 'YYYY-MM-DD', input: 'YYYY-MM-DD' }"
                  :rows="3"
                  :columns="4"
                  is-inline
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="block">
          <div
            class="block-content block-content-sm block-content-full bg-body-light rounded-bottom"
          >
            <div class="row">
              <div class="col-6 text-left">
                <button type="button" @click="cancel()" class="btn btn-danger" data-wizard="next">
                  <i class="fa fa-times ml-1"></i>
                  Hủy
                </button>
                <button
                  type="button"
                  @click.prevent="create()"
                  class="btn btn-primary ml-2"
                  data-wizard="finish"
                >
                  <i class="fa fa-check ml-1"></i> Thêm mới
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- END Page Content -->
    <div v-if="!$gate.isAdminOrAuthor()">
      <not-found></not-found>
    </div>
  </main>
  <!-- END Main Container -->
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      touristRoutes: [],
      promotions: [],
      form: new Form({
        tour_tourist_route: {},
        tour_promotion: {},
        dates: []
      })
    };
  },
  methods: {
    cancel() {
      swalWithBootstrapButtons
        .fire({
          title: "Bạn có chắc không?",
          text: "Bạn sẽ không thể hoàn nguyên điều này!",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Vâng, hủy nó đi!",
          cancelButtonText: "Không, ở lại đây!",
          reverseButtons: true
        })
        .then(result => {
          if (result.value) {
            swalWithBootstrapButtons
              .fire("Đã hủy!", "Đối tượng đã được hủy bỏ", "error")
              .then(() => {
                this.form.reset();
                this.$router.push("/admin/tourist-route");
              });
          } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              "Oke",
              "Đối tượng của bạn vẫn được giữ lại :))",
              "success"
            );
          }
        });
    },
    create() {
      let dates = this.form.dates;

      for (let index = 0; index < dates.length; index++) {
        const element = dates[index];
        this.form.dates[index] = moment(element).format("YYYY-MM-DD");
      }

      this.$Progress.start();
      this.form
        .post(this.$Api + "/tour")
        .then(response => {
          console.log(response);
          Toast.fire({
            type: "success",
            title: "Tạo mới thành công!"
          });
          this.$Progress.finish();
          this.form.reset();
          this.$router.push("/admin/tour");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    loadListTouristRoutes() {
      axios
        .get(this.$Api + "/tourist-route/select/search?q=")
        .then(response => {
          this.touristRoutes = response.data;
        });
    },
    loadListPromotions() {
      axios.get(this.$Api + "/promotion/select/search?q=").then(response => {
        this.promotions = response.data;
      });
    },
    onSearchTouristRoute(search, loading) {
      loading(true);
      this.searchTouristRoute(loading, search, this);
    },
    searchTouristRoute: _.debounce((loading, search, vm) => {
      console.log(search);
      axios
        .get(vm.$Api + `/tourist-route/select/search?q=${search}`)
        .then(response => {
          vm.touristRoutes = response.data;
          loading(false);
        });
    }, 350),
    onSearchPromotion(search, loading) {
      loading(true);
      this.searchTouristRoute(loading, search, this);
    },
    searchPromotion: _.debounce((loading, search, vm) => {
      console.log(search);
      axios
        .get(vm.$Api + `/promotion/select/search?q=${search}`)
        .then(response => {
          vm.promotions = response.data;
          loading(false);
        });
    }, 350)
  },
  created() {
    this.loadListTouristRoutes();
    this.loadListPromotions();
  }
};
</script>