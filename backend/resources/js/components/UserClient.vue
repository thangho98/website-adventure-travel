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
            Khách hàng
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            >Danh sách tài khoản khách hàng</small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Quản lý</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Khách hàng</a>
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
          <div class="block-options"></div>
        </div>
        <div class="block-content">
          <div class="table-responsive">
            <table id="js-dataTable" class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Giới tính</th>
                  <th>Ngày sinh</th>
                  <th>Địa chỉ</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="userClient in user_clients" :key="userClient.user_id">
                  <td>{{userClient.user_id}}</td>
                  <td>{{userClient.user_name}}</td>
                  <td>{{userClient.user_email}}</td>
                  <td>{{userClient.user_phone}}</td>
                  <td v-if="userClient.user_gender == 1">
                    <span class="badge badge-primary">Nam</span>
                  </td>
                  <td v-else>
                    <span class="badge badge-danger">Nữ</span>
                  </td>
                  <td>{{userClient.user_birthday}}</td>
                  <td>{{userClient.user_address}}</td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button
                        type="button"
                        class="btn btn-sm btn-light"
                        data-toggle="tooltip"
                        title="View Client"
                        @click="viewDetail(userClient.user_id)"
                      >
                        <i class="fa fa-fw fa-eye"></i>
                      </button>
                      <button
                        type="button"
                        class="btn btn-sm btn-light"
                        data-toggle="tooltip"
                        title="Remove Client"
                        @click="deleteObject(userClient.user_id)"
                      >
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
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
            <h5 class="modal-title" id="showInfoLabel">Thông tin chi tiết về người dùng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div v-if="user_info != null">
              <div v-if="user_info.user_client != null" class="row">
                <div class="col-6">
                  <b>ID:</b>
                  {{user_info.user_client.user_id}}
                  <br />
                  <b>Họ và tên:</b>
                  {{user_info.user_client.user_name}}
                  <br />
                  <b>Ngày sinh:</b>
                  {{user_info.user_client.user_birthday}}
                  <br />
                  <b>Giới tính:</b>
                  <span
                    v-show="user_info.user_client.user_gender == 1"
                    class="badge badge-primary"
                  >Nam</span>
                  <span
                    v-show="user_info.user_client.user_gender != 1"
                    class="badge badge-danger"
                  >Nữ</span>
                  <br />
                </div>
                <div class="col-6">
                  <b>SĐT:</b>
                  {{user_info.user_client.user_phone}}
                  <br />
                  <b>Email:</b>
                  {{user_info.user_client.user_email}}
                  <br />
                  <b>Địa chỉ:</b>
                  {{user_info.user_client.user_email}}
                  <br />
                </div>
              </div>
              <div class="row my-3">
                <h5 class="ml-3">Danh sách tour đã đặt</h5>
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-vcenter table-hover table-striped">
                      <thead class="thead-dark">
                        <tr>
                          <th>ID</th>
                          <th>Mã tour</th>
                          <th>Chuyến du lịch</th>
                          <th>Số lượng trẻ em</th>
                          <th>Số lượng người lớn</th>
                          <th>Ngày đặt</th>
                          <th>Tổng tiền</th>
                          <th>Tình trạng</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in user_info.booking_tours" :key="'rowtour'+index">
                          <th class="text-center" scope="row">{{item.bt_id}}</th>
                          <td class="font-w600 font-size-sm">{{item.tour_code}}</td>
                          <td class="d-none d-sm-table-cell">{{item.tr_name}}</td>
                          <td class="d-none d-sm-table-cell">{{item.bt_num_child}}</td>
                          <td class="d-none d-sm-table-cell">{{item.bt_num_adult}}</td>
                          <td class="d-none d-sm-table-cell">{{item.bt_date | myDate}}</td>
                          <td
                            class="d-none d-sm-table-cell"
                          >{{item.bt_total_price | formatPrice }} VNĐ</td>
                          <td class="d-none d-sm-table-cell">{{item.bt_id}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <h5 class="ml-3">Danh sách các bình luận</h5>
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-vcenter table-hover table-striped">
                      <thead class="thead-dark">
                        <tr>
                          <th>ID</th>
                          <th>Thời gian bình luận</th>
                          <th>Chuyến du lịch</th>
                          <th>Nội dung</th>
                          <th>Điểm đánh giá</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in user_info.reviews" :key="'rowtour'+index">
                          <th class="text-center" scope="row">{{item.revi_id}}</th>
                          <td class="font-w600 font-size-sm">{{item.revi_time | myDate}}</td>
                          <td class="d-none d-sm-table-cell">{{item.tr_name}}</td>
                          <td class="d-none d-sm-table-cell">{{item.revi_content}}</td>
                          <td class="d-none d-sm-table-cell">
                            <i
                              v-for="n in item.revi_star"
                              :key="'star'+n"
                              class="fa fa-star yellow"
                            ></i>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
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
      user_info: {},
      user_clients: []
    };
  },
  methods: {
    viewDetail(id) {
      $("#progressModal").modal("show");
      axios.get(this.$Api + "/user-client/" + id).then(response => {
        this.user_info = response.data;
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
          .get(this.$Api + "/user-client")
          .then(({ data }) => (this.user_clients = data));
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
            .delete(this.$Api + "/user-client/" + id)
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
  },
  updated: function ()  {
    this.$nextTick(function() {
      this.$root.initDatatables();
    });
  }
};
</script>
