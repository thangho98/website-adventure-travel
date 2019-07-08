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
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
              <thead>
                <tr>
                  <th>Mã tour</th>
                  <th>Chuyến du lịch</th>
                  <th>Ngày bắt đầu</th>
                  <th>Số lượng đã đặt</th>
                  <th>Giá tour</th>
                  <th>Khuyến mãi</th>
                  <th>Tổng tiền vé</th>
                  <th>Chi phí</th>
                  <th>Tình trạng</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
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
                  <td v-show="tour.tour_status == 0">Chưa khởi hành</td>
                  <td v-show="tour.tour_status == 1">Chốt danh sách</td>
                  <td v-show="tour.tour_status == 2">Đã kết thúc</td>
                  <td v-show="tour.tour_status == 3">Đã duyệt chi phí</td>
                  <td class="text-center" v-show="tour.tour_status == 0">
                    <a href="#" data-toggle="tooltip" title="Duyệt chi phí">
                      <i class="fa fa-check yellow"></i>
                    </a>
                    /
                    <router-link
                      :to="{ name:'editTour', params: { tour_id: tour.tour_id } }"
                      data-toggle="tooltip"
                      title="Sửa"
                    >
                      <i class="fa fa-edit blue"></i>
                    </router-link>/
                    <a href="#" data-toggle="tooltip" title="Cập nhật chi phí">
                      <i class="fa fa-tags green"></i>
                    </a>/
                    <a
                      href="#"
                      @click="deleteObject(tour.tour_id)"
                      data-toggle="tooltip"
                      title="Xóa"
                    >
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                  <td class="text-center" v-show="tour.tour_status == 1">
                    <a href="#" data-toggle="tooltip" title="Duyệt chi phí">
                      <i class="fa fa-check yellow"></i>
                    </a>
                    /
                    <a href="#" data-toggle="tooltip" title="Sửa">
                      <i class="fa fa-edit blue"></i>
                    </a>/
                    <a href="#" data-toggle="tooltip" title="Cập nhật chi phí">
                      <i class="fa fa-tags green"></i>
                    </a>/
                    <a href="#" data-toggle="tooltip" title="Xóa">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                  <td class="text-center" v-show="tour.tour_status == 2">
                    <a
                      href="#"
                      v-show="!$gate.isAdmin() || tour.tour_cost == 0"
                      data-toggle="tooltip"
                      title="Duyệt chi phí"
                    >
                      <i class="fa fa-check yellow"></i>
                    </a>
                    <a
                      href="#"
                      v-show="$gate.isAdmin() && tour.tour_cost != 0"
                      data-toggle="tooltip"
                      title="Duyệt chi phí"
                      @click="approvedTour(tour.tour_id)"
                    >
                      <i class="fa fa-check yellow"></i>
                    </a>
                    /
                    <a href="#" data-toggle="tooltip" title="Sửa">
                      <i class="fa fa-edit blue"></i>
                    </a>/
                    <a
                      href="#"
                      @click="showModal(tour)"
                      data-toggle="tooltip"
                      title="Cập nhật chi phí"
                    >
                      <i class="fa fa-tags green"></i>
                    </a>/
                    <a href="#" data-toggle="tooltip" title="Xóa">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                  <td class="text-center" v-show="tour.tour_status == 3">
                    <a href="#" data-toggle="tooltip" title="Duyệt chi phí">
                      <i class="fa fa-check yellow"></i>
                    </a>
                    /
                    <a href="#" data-toggle="tooltip" title="Sửa">
                      <i class="fa fa-edit blue"></i>
                    </a>/
                    <a href="#" data-toggle="tooltip" title="Cập nhật chi phí">
                      <i class="fa fa-tags green"></i>
                    </a>/
                    <a href="#" data-toggle="tooltip" title="Xóa">
                      <i class="fa fa-trash red"></i>
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
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">Cập nhật chi phí tour: {{form.tour_code}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="updateTourCost()">
            <div class="modal-body">
              <div class="form-group">
                <label for="tour_cost" class="control-label">Chi phí tour</label>
                <div class="input-group">
                  <input
                    v-model="form.tour_cost"
                    type="number"
                    min="0"
                    step="1000000"
                    name="tour_cost"
                    class="form-control text-center"
                    :class="{ 'is-invalid': form.errors.has('tour_cost') }"
                    placeholder=".."
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">VNĐ</span>
                  </div>
                </div>
                <has-error :form="form" field="tour_cost"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-success">Cập nhật</button>
            </div>
          </form>
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
      tours: [],
      form: new Form({
        tour_id: "",
        tour_code: "",
        tour_cost: ""
      })
    };
  },
  methods: {
    showModal(object) {
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(object);
    },
    updateTourCost() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put(this.$Api + "/tour/update/cost/" + this.form.tour_id)
        .then(() => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            type: "success",
            title: "Thông tin đã được cập nhật!"
          });
          this.$Progress.finish();
          Fire.$emit("reloadData");
        })
        .catch(() => {
          this.$Progress.fail();
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
    },
    approvedTour: function(id) {
      Swal.fire({
        title: "Bạn có chắc duyệt chi phí cho tour này không?",
        text: "Bạn sẽ không thể hoàn nguyên điều này!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Vâng, duyệt nó đi!"
      }).then(result => {
        // Send request to the server
        if (result.value) {
          this.form
            .put(this.$Api + "/tour/update/approved/" + id)
            .then(() => {
              Swal.fire(
                "Đã cập nhật!",
                "Tour đã được duyệt chi phí.",
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
