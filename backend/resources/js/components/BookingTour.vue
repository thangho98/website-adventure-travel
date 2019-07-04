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
            Vé đặt book
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            >Danh sách vé đặt book</small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Quản lý</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Vé đặt book</a>
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
            <router-link to="/admin/book/add" class="btn btn-success">
              <i class="fas fa-plus white fa-fw"></i>
            </router-link>
          </div>
        </div>
        <div class="block-content">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Mã Tour</th>
                  <th>Tên chuyến đi</th>
                  <th>Khách hàng</th>
                  <th>Số lượng trẻ em</th>
                  <th>Số lượng người lớn</th>
                  <th>Tổng tiền</th>
                  <th>Ngày đặt</th>
                  <th>Tình trạng</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="book in bookings.data" :key="book.bt_id">
                  <td>{{book.bt_id}}</td>
                  <td>{{book.tour_code}}</td>
                  <td>{{book.tr_name}}</td>
                  <td>{{book.user_name}}</td>
                  <td>{{book.bt_num_child}}</td>
                  <td>{{book.bt_num_adult}}</td>
                  <td>{{book.bt_total_price | formatPrice}} VNĐ</td>
                  <td>{{book.bt_date | myDate}}</td>
                  <td v-if="book.bt_status == 0">
                    <span class="badge badge-primary">Đang đặt</span>
                  </td>
                  <td v-else-if="book.bt_status == 1">
                    <span class="badge badge-success">Đã thanh toán</span>
                  </td>
                  <td v-else>
                    <span class="badge badge-danger">Đã hủy</span>
                  </td>
                  <td v-show="book.bt_status == 0">
                    <a href="#" @click="updateStatusPayed(book.bt_id)">
                      <i class="fa fa-check blue"></i>
                    </a>/
                    <a href="#" @click="updateStatusCancel(book.bt_id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                  <td v-show="book.bt_status != 0">
                    <a href disabled>
                      <i class="fa fa-check blue"></i>
                    </a>/
                    <a href disabled>
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <pagination :data="bookings" @pagination-change-page="getResults"></pagination>
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
      bookings: {},
      form: new Form({})
    };
  },
  methods: {
    getResults(page = 1) {
      axios.get(this.$Api + "/booking-tour?page=" + page).then(response => {
        this.bookings = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios
          .get(this.$Api + "/booking-tour")
          .then(({ data }) => (this.bookings = data));
      }
    },
    updateStatusCancel: function(id) {
      Swal.fire({
        title: "Bạn có chắc không?",
        text: "Bạn sẽ cập nhật trạng thái hủy cho vé này",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Vâng, hủy vé này đi!"
      }).then(result => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete(this.$Api + "/booking-tour/" + id)
            .then(() => {
              Swal.fire("Đã xóa!", "Vé đặt đã hủy thành công", "success");
              Fire.$emit("reloadData");
            })
            .catch(() => {
              Swal.fire("Thất bại!", "Có gì đó không đúng.", "warning");
            });
        }
      });
    },
    updateStatusPayed: function(id) {
      Swal.fire({
        title: "Bạn có chắc không?",
        text: "Bạn sẽ sẽ cập nhật thanh toán cho vé này!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Vâng, cập nhật thanh toán!"
      }).then(result => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete(this.$Api + "/booking-tour/" + id)
            .then(() => {
              Swal.fire(
                "Đã xóa!",
                "Vé đặt đã được cập nhật thanh toán",
                "success"
              );
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
