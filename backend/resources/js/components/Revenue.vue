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
            Doanh thu
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            >Danh sách doanh thu</small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Thống kê</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Doanh thu</a>
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
            <router-link to="/admin/revenue/add" class="btn btn-success">
              <i class="fas fa-plus white fa-fw"></i>
            </router-link>
          </div>
        </div>
        <div class="block-content">
          <div class="table-responsive">
            <table id="js-datatables" class="table table-bordered table-striped table-vcenter">
              <thead>
                <tr>
                  <th>Tháng</th>
                  <th>Năm</th>
                  <th>Quý</th>
                  <th>Chi phí</th>
                  <th>Tổng tiền vé</th>
                  <th>Lợi nhuận</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="revenue in revenues" :key="revenue.reve_id">
                  <td>{{revenue.reve_month}}</td>
                  <td>{{revenue.reve_quarter}}</td>
                  <td>{{revenue.reve_year}}</td>
                  <td>{{revenue.reve_cost | formatPrice}} VNĐ</td>
                  <td>{{revenue.reve_total_fare | formatPrice}} VNĐ</td>
                  <td>{{revenue.reve_income | formatPrice}} VNĐ</td>

                  <td class="text-center">
                    <a
                      href="#"
                      @click="viewDetail(revenue)"
                      data-toggle="tooltip"
                      title="Xem chi tiết"
                    >
                      <i class="fa fa-fw fa-eye"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END Full Table -->
    </div>
    <!-- END Page Content -->
    <div v-if="!$gate.isAdminOrAuthor()">
      <not-found></not-found>
    </div>
    <div
      class="modal fade bd-example-modal-lg"
      id="showInfo"
      tabindex="-1"
      role="dialog"
      aria-labelledby="showInfoLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="showInfoLabel"
            >Thông tin chi tiết doanh thu tháng {{month}} năm {{year}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row my-3">
              <h5 class="ml-3">Danh sách các tour tháng {{month}} năm {{year}}</h5>
              <div class="col-12">
                <div class="table-responsive">
                  <table class="table table-vcenter table-hover table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th>Mã tour</th>
                        <th>Chuyến du lịch</th>
                        <th>Ngày bắt đầu</th>
                        <th>Số lượng đã đặt</th>
                        <th>Giá tour</th>
                        <th>Khuyến mãi</th>
                        <th>Tổng tiền vé</th>
                        <th>Chi phí</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="tour in tours" :key="tour.tour_id">
                        <td>{{tour.tour_code}}</td>
                        <td>{{tour.tr_name}}</td>
                        <td>{{tour.tour_time_start | myDate}}</td>
                        <td>{{tour.tour_slot_book}}/{{tour.tr_max_slot}}</td>
                        <td>{{tour.tour_price | formatPrice}} VNĐ</td>
                        <td v-show="tour.prom_name != null">{{tour.prom_name}}</td>
                        <td v-show="tour.prom_name == null">Không có khuyến mãi</td>
                        <td>{{tour.tour_total_fare | formatPrice}} VNĐ</td>
                        <td>{{tour.tour_cost | formatPrice}} VNĐ</td>
                      </tr>
                    </tbody>
                    <!-- <tfoot>
                      <tr>
                        <td colspan="6" class="text-center">Tổng cộng</td>
                        <td>{{sum_tour_total_fare | formatPrice}} VNĐ</td>
                        <td>{{sum_tour_cost | formatPrice}} VNĐ</td>
                      </tr>
                    </tfoot>-->
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- END Main Container -->
</template>

<script>
export default {
  data() {
    return {
      revenues: [],
      tours: [],
      sum_tour_total_fare: "",
      sum_tour_cost: "",
      month: "",
      year: "",
      form: new Form({})
    };
  },
  methods: {
    viewDetail(revenue) {
      this.month = revenue.reve_month;
      this.year = revenue.reve_year;
      $("#progressModal").modal("show");
      axios.get(this.$Api + "/revenue/" + revenue.reve_id).then(response => {
        console.log(response.data);
        this.tours = response.data.list_tour;
        this.sum_tour_total_fare = response.data.sum_tour_total_fare;
        this.sum_tour_cost = response.data.sum_tour_cost;
        $("#progressModal").modal("hide");
        $(".modal.show").modal("hide");
        $("#progressModal").on("hidden.bs.modal", function() {
          $("#showInfo").modal("show");
        });
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios
          .get(this.$Api + "/revenue")
          .then(({ data }) => (this.revenues = data));
      }
    }
  },
  created() {
    this.loadData();
    Fire.$on("reloadData", () => {
      this.loadData();
    });
    //setInterval(()=>this.loadData(), 3000);
  },
  updated: function() {
    this.$nextTick(function() {
      this.$root.initDatatables();
    });
  }
};
</script>
