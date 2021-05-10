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
            Khuyến mãi
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            >Danh sách khuyến mãi</small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Quản lý</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Khuyến mãi</a>
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
            <!-- <button type="button" class="btn-block-option">
              <i class="si si-settings"></i>
            </button>-->
            <button class="btn btn-success" @click="newModal">
              <i class="fas fa-plus white fa-fw"></i>
            </button>
          </div>
        </div>
        <div class="block-content">
          <div class="table-responsive">
            <table id="js-dataTable" class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Ảnh bìa</th>
                  <th>Tên</th>
                  <th>Mô tả</th>
                  <th>Phần trăm khuyến mãi</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="promotion in promotions" :key="promotion.prom_id">
                  <td>{{promotion.prom_id}}</td>
                  <td v-if="promotion.prom_banner.length > 0">
                    <a data-fancybox="gallery" :href="loadImage(promotion.prom_banner)">
                      <img
                        class="thumbnail"
                        :src="loadImage(promotion.prom_banner)"
                        height="75px;"
                        width="150px;"
                      />
                    </a>
                  </td>
                  <td v-else class="font-w600 font-size-sm">Chưa có ảnh bìa</td>
                  <td>{{promotion.prom_name}}</td>
                  <td>{{promotion.prom_description}}</td>
                  <td>{{promotion.prom_percent_promotion}} %</td>
                  <td>
                    <a href="#" @click="updateModal(promotion)">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    /
                    <a href="#" @click="deleteObject(promotion.prom_id)">
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
            <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Tạo mới</h5>
            <h5 class="modal-title" v-show="editMode" id="addNewLabel">Cập nhật</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editMode ? update() : create()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.prom_name"
                  type="text"
                  name="prom_name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('prom_name') }"
                  placeholder="Tên khuyến mãi"
                />
                <has-error :form="form" field="prom_name"></has-error>
              </div>
              <div class="form-group">
                <textarea
                  v-model="form.prom_description"
                  name="prom_description"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('prom_description') }"
                  placeholder="Mô tả"
                ></textarea>
                <has-error :form="form" field="prom_description"></has-error>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input
                    v-model="form.prom_percent_promotion"
                    type="number"
                    min="0"
                    max="100"
                    step="1"
                    name="prom_percent_promotion"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('prom_percent_promotion') }"
                    placeholder="Phần trăm khuyến mãi"
                  />
                  <div class="input-group-append">
                    <span class="input-group-text input-group-text-alt">%</span>
                  </div>
                </div>
                <has-error :form="form" field="prom_percent_promotion"></has-error>
              </div>
              <div class="form-group">
                <label for="prom_banner" class="control-label">Ảnh bìa</label>
                <br />
                <input
                  hidden
                  id="prom_banner"
                  ref="prom_banner"
                  type="file"
                  accept="image/*"
                  name="prom_banner"
                  @change="updateImage"
                  class="form-input"
                />
                <img
                  @click="chooseImage"
                  :src="getImageModal()"
                  class="thumbnail ml-2 border border-primary"
                  height="125px;"
                  width="250px;"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
              <button v-show="editMode" type="submit" class="btn btn-success">Cập nhật</button>
              <button v-show="!editMode" type="submit" class="btn btn-primary">Tạo mới</button>
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
      editMode: false,
      promotions: [],
      form: new Form({
        prom_id: "",
        prom_name: "",
        prom_banner: "",
        prom_description: "",
        prom_percent_promotion: Number
      })
    };
  },
  methods: {
    chooseImage() {
      this.$refs.prom_banner.click();
    },
    getImageModal() {
      let prom_banner = "";
      if (this.form.prom_banner.length != 0) {
        prom_banner =
          this.form.prom_banner.length > 200
            ? this.form.prom_banner
            : this.$Host + "/img/promotion/" + this.form.prom_banner;
      } else {
        prom_banner = this.$Host + "/assets/media/img/new_seo-10-75.png";
      }
      return prom_banner;
    },
    updateImage(e) {
      let file = e.target.files[0];
      let reader = new FileReader();
      let limit = 1024 * 1024 * 2;
      if (file["size"] > limit) {
        Swal.fire({
          type: "error",
          title: "Rất tiếc ...",
          text: "Bạn đang tải lên một tệp lớn"
        });
        return false;
      }
      reader.onloadend = file => {
        this.form.prom_banner = reader.result;
      };
      reader.readAsDataURL(file);
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios
          .get(this.$Api + "/promotion")
          .then(({ data }) => (this.promotions = data));
      }
    },
    loadImage(imageName) {
      return this.$Host + "/img/promotion/" + imageName;
    },
    newModal() {
      this.form.reset();
      $("#addNew").modal("show");
      this.editMode = false;
    },
    updateModal(object) {
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(object);
    },
    create() {
      this.$Progress.start();
      this.form
        .post(this.$Api + "/promotion")
        .then(() => {
          Fire.$emit("reloadData");
          $("#addNew").modal("hide");
          Toast.fire({
            type: "success",
            title: "Tạo mới thành công!"
          });
          this.$Progress.finish();
          this.form.reset();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    update() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put(this.$Api + "/promotion/" + this.form.prom_id)
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
            .delete(this.$Api + "/promotion/" + id)
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
