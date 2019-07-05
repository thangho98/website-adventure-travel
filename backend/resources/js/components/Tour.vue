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
            >Danh sách chuyến du lịch</small>
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

    <!-- Page Content -->
    <div class="content">
      <!-- Full Table -->
      <div class="block">
        <div class="block-header">
          <h3 class="block-title"></h3>
          <div class="block-options">
            <router-link to="/admin/tour/add" class="btn btn-success">
              <i class="fas fa-plus white fa-fw"></i>
            </router-link>
          </div>
        </div>
        <div class="block-content">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
              <thead>
                <tr>
                  <th>Mã tour</th>
                  <th>Chuyến du lịch</th>
                  <th>Ngày bắt đầu</th>
                  <th>Số lượng đã đặt</th>
                  <th>Giá tour</th>
                  <th>Khuyến mãi</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="tour in tours.data" :key="tour.tour_id">
                  <td>{{tour.tour_code}}</td>
                  <td>{{tour.tr_name}}</td>
                  <td>{{tour.tour_time_start | myDate}}</td>
                  <td>{{tour.tour_slot_book}}/{{tour.tr_max_slot}}</td>
                  <td>{{tour.tour_price | formatPrice}} VNĐ</td>
                  <td v-show="tour.prom_name != null">{{tour.prom_name}}</td>
                  <td v-show="tour.prom_name == null">Không có khuyến mãi</td>
                  <td>
                    <router-link :to="{ name:'editTour', params: { tour_id: tour.tour_id } }">
                      <i class="fa fa-edit blue"></i>
                    </router-link>/
                    <a href="#" @click="deleteObject(tour.tour_id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <pagination :data="tours" @pagination-change-page="getResults"></pagination>
          </div>
        </div>
      </div>
      <!-- END Full Table -->
    </div>
    <!-- END Page Content -->
    <div v-if="!$gate.isAdminOrAuthor()">
      <not-found></not-found>
    </div>
  </main>
  <!-- END Main Container -->
</template>

<script>
export default {
  data() {
    return {
      tours: {},
      form: new Form({})
    };
  },
  methods: {
    getResults(page = 1) {
      axios.get(this.$Api + "/tour?page=" + page).then(response => {
        this.tours = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get(this.$Api + "/tour").then(({ data }) => (this.tours = data));
      }
    },
    deleteObject: function(id) {
      Swal.fire({
        title: "Bạn có chắc không?",
        text: "Bạn sẽ không thể hoàn nguyên điều này!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Vâng, xóa nó đi!"
      }).then(result => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete(this.$Api + "/tour/" + id)
            .then(() => {
              Swal.fire("Đã xóa!", "Đối tượng của bạn đã bị xóa.", "success");
              Fire.$emit("reloadData");
            })
            .catch(() => {
              Swal.fire("Thất bại!", "Có gì đó không đúng.", "warning");
            });
        }
      });
    }
  },
  created() {
    this.loadData();
    Fire.$on("reloadData", () => {
      this.loadData();
    });
    //setInterval(()=>this.loadData(), 3000);
  }
};
</script>
