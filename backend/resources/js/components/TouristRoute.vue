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
            Tuyến du lịch
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            >Danh sách tuyến du lịch</small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Quản lý</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Tuyến du lịch</a>
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
            <router-link to="/admin/tourist-route/add" class="btn btn-success">
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
                  <th>Tên</th>
                  <th>Thể loại</th>
                  <th>Thời gian</th>
                  <th>Giá gốc</th>
                  <th>Nơi khởi hành</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="tr in touristRoutes.data" :key="tr.tr_id">
                  <td>{{tr.tr_id}}</td>
                  <td>{{tr.tr_name}}</td>
                  <td>{{tr.cate_name | upText}}</td>
                  <td>{{tr.tr_time}} ngày</td>
                  <td>{{tr.tr_original_price | formatPrice}} VNĐ</td>
                  <td>{{tr.loca_name | upText}}</td>
                  <td class="text-center">
                    <a href="#" @click="update(tr.tr_id)">
                      <i class="fa fa-eye orange"></i>
                    </a>/
                    <router-link :to="{ name:'editTouristRoute', params: { tr_id: tr.tr_id } }">
                      <i class="fa fa-edit blue"></i>
                    </router-link>/
                    <a href="#" @click="deleteObject(tr.tr_id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-if="touristRoutes != ''" class="card-footer">
            <pagination :data="touristRoutes" @pagination-change-page="getResults"></pagination>
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
      touristRoutes: {}
    };
  },
  methods: {
    getResults(page = 1) {
      axios.get(this.$Api + "/tourist-route?page=" + page).then(response => {
        this.touristRoutes = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios
          .get(this.$Api + "/tourist-route")
          .then(({ data }) => (this.touristRoutes = data));
      }
    },
    loadImage(imageName) {
      return this.$Host + "/img/tourist-route/" + imageName;
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
            .delete(this.$Api + "/tourist-route/" + id)
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
