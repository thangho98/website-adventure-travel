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
            Tuyến du lịch
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            >Thêm tuyến du lịch</small>
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
        <!-- <div class="block-header"></div> -->
        <div class="block-content">
          <div class="row">
            <div class="col-md-12">
              <!-- Progress Wizard -->
              <div class="js-wizard-simple block block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      href="#wizard-progress-step1"
                      data-toggle="tab"
                    >1. Thông tin tuyến du lịch</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#wizard-progress-step2" data-toggle="tab">2. Hình ảnh</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      href="#wizard-progress-step3"
                      data-toggle="tab"
                    >3. Chi tiết tuyến du lịch</a>
                  </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form @submit.prevent="create()">
                  <!-- Wizard Progress Bar -->
                  <div class="block-content block-content-sm">
                    <div class="progress" data-wizard="progress" style="height: 8px;">
                      <div
                        class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                        role="progressbar"
                        style="width: 30%;"
                        aria-valuenow="30"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                  </div>
                  <!-- END Wizard Progress Bar -->

                  <!-- Steps Content -->
                  <div
                    class="block-content block-content-full tab-content px-md-5"
                    style="min-height: 300px;"
                  >
                    <!-- Step 1 -->
                    <div class="tab-pane active" id="wizard-progress-step1" role="tabpanel">
                      <div class="form-row">
                        <div class="form-group col-6">
                          <label for>
                            Tên
                            <span class="text-danger">*</span>
                          </label>
                          <input
                            v-model="form.tr_name"
                            type="text"
                            name="tr_name"
                            class="form-control"
                            required
                            :class="{ 'is-invalid': form.errors.has('tr_name') }"
                          >
                          <has-error :form="form" field="tr_name"></has-error>
                        </div>
                        <div class="form-group col-6">
                          <label for>
                            Thể loại
                            <span class="text-danger">*</span>
                          </label>
                          <v-select
                            v-model="form.tr_category"
                            name="tr_category"
                            :class="{ 'is-invalid': form.errors.has('tr_category') }"
                            required
                            :options="categories"
                            label="cate_name"
                            :reduce="cate => cate.cate_id"
                          />
                          <has-error :form="form" field="tr_category"></has-error>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-6">
                          <label for>
                            Thời gian
                            <span class="text-danger">*</span>
                          </label>
                          <div class="input-group">
                            <input
                              @change="changeTime"
                              v-model="form.tr_time"
                              type="number"
                              name="tr_time"
                              min="1"
                              step="1"
                              class="form-control text-center"
                              required
                              :class="{ 'is-invalid': form.errors.has('tr_time') }"
                            >
                            <div class="input-group-append">
                              <span class="input-group-text input-group-text-alt">Ngày</span>
                            </div>
                          </div>
                          <has-error :form="form" field="tr_time"></has-error>
                        </div>
                        <div class="form-group col-6">
                          <label for>
                            Giá gốc
                            <span class="text-danger">*</span>
                          </label>
                          <div class="input-group">
                            <input
                              v-model="form.tr_original_price"
                              type="number"
                              min="0"
                              step="100000"
                              name="tr_original_price"
                              class="form-control text-center"
                              required
                              :class="{ 'is-invalid': form.errors.has('tr_original_price') }"
                            >
                            <div class="input-group-append">
                              <span class="input-group-text input-group-text-alt">VNĐ</span>
                            </div>
                          </div>
                          <has-error :form="form" field="tr_original_price"></has-error>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-6">
                          <label for>
                            Số chỗ tối đa
                            <span class="text-danger">*</span>
                          </label>
                          <input
                            v-model="form.tr_max_slot"
                            type="number"
                            min="1"
                            step="1"
                            name="tr_max_slot"
                            class="form-control text-center"
                            required
                            :class="{ 'is-invalid': form.errors.has('tr_max_slot') }"
                          >
                          <has-error :form="form" field="tr_max_slot"></has-error>
                        </div>
                        <div class="form-group col-6">
                          <label for>
                            Nơi khởi hành
                            <span class="text-danger">*</span>
                          </label>
                          <v-select
                            v-model="form.tr_location"
                            name="tr_location"
                            :class="{ 'is-invalid': form.errors.has('tr_location') }"
                            required
                            :filterable="false"
                            @search="onSearchLocation"
                            :options="locations"
                            label="loca_name"
                            :reduce="location => location.loca_id"
                          >
                            <template slot="no-options">Chọn một địa điểm</template>
                            <template slot="option" slot-scope="location">
                              <div class="d-center">{{ location.loca_name }}</div>
                            </template>
                            <template slot="selected-option" slot-scope="location">
                              <div class="selected d-center">{{ location.loca_name }}</div>
                            </template>
                          </v-select>
                          <has-error :form="form" field="tr_location"></has-error>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-12">
                          <label for>
                            Các điểm đến
                            <span class="text-danger">*</span>
                          </label>
                          <v-select
                            multiple
                            v-model="form.tr_listDestinations"
                            name="tr_listDestinations"
                            :class="{ 'is-invalid': form.errors.has('tr_listDestinations') }"
                            required
                            :filterable="false"
                            @search="onSearchLocation"
                            :options="locations"
                            label="loca_name"
                            :reduce="location => location.loca_id"
                          >
                            <template slot="no-options">Chọn một địa điểm</template>
                            <template slot="option" slot-scope="location">
                              <div class="d-center">{{ location.loca_name }}</div>
                            </template>
                            <template slot="selected-option" slot-scope="location">
                              <div class="selected d-center">{{ location.loca_name }}</div>
                            </template>
                          </v-select>
                          <has-error :form="form" field="tr_listDestinations"></has-error>
                        </div>
                      </div>
                    </div>
                    <!-- END Step 1 -->

                    <!-- Step 2 -->
                    <div class="tab-pane" id="wizard-progress-step2" role="tabpanel">
                      <table class="table table-striped table-bordered table-hover">
                        <!-- <thead>
                          <tr>
                            <td></td>
                            <td></td>
                          </tr>
                        </thead>-->
                        <tbody>
                          <tr>
                            <td class="text-left">
                              <label for="tr_poster" class="control-label">Ảnh bìa</label>
                            </td>
                            <td class="text-left">
                              <input
                                hidden
                                id="tr_poster"
                                ref="tr_poster"
                                type="file"
                                accept="image/*"
                                name="tr_poster"
                                @change="updateImage"
                                class="form-input"
                                :class="{ 'is-invalid': form.errors.has('tr_poster') }"
                              >
                              <img
                                @click="chooseImage"
                                :src="getImageModal()"
                                class="thumbnail ml-2 border border-primary"
                                height="75px;"
                                width="150px;"
                              >
                              <has-error :form="form" field="tr_poster"></has-error>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-left">
                              <label for="tr_image" class="control-label">Hình ảnh bổ sung</label>
                            </td>
                            <td class="text-left">
                              <vue-upload-multiple-image
                                id="tr_image"
                                @upload-success="uploadImageSuccess"
                                @before-remove="beforeRemove"
                                @edit-image="editImage"
                                :data-images="images"
                              ></vue-upload-multiple-image>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- END Step 2 -->

                    <!-- Step 3 -->
                    <div class="tab-pane" id="wizard-progress-step3" role="tabpanel">
                      <table id="images" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <td style="width: 20%;">Ngày thứ</td>
                            <td>Mô tả</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tourist-route-detail-add
                            v-for="(item, index) in form.tr_listTouristRouteDetails"
                            v-bind:trd.sync="item"
                            v-bind:index="index"
                            v-bind:key="'trd'+index"
                          ></tourist-route-detail-add>
                        </tbody>
                      </table>
                    </div>
                    <!-- END Step 3 -->
                  </div>
                  <!-- END Steps Content -->

                  <!-- Steps Navigation -->
                  <div
                    class="block-content block-content-sm block-content-full bg-body-light rounded-bottom"
                  >
                    <div class="row">
                      <div class="col-6">
                        <button type="button" class="btn btn-secondary" data-wizard="prev">
                          <i class="fa fa-angle-left mr-1"></i> Trước
                        </button>
                      </div>
                      <div class="col-6 text-right">
                        <button type="button" class="btn btn-secondary" data-wizard="next">
                          Kế tiếp
                          <i class="fa fa-angle-right ml-1"></i>
                        </button>
                        <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                          <i class="fa fa-check mr-1"></i> Hoàn tất
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
              </div>
              <!-- END Progress Wizard -->
            </div>
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
import { log } from "util";
export default {
  data() {
    return {
      editMode: false,
      categories: [],
      locations: [],
      images: [],
      form: new Form({
        tr_id: "",
        tr_name: "",
        tr_category: 0,
        tr_original_price: 100000,
        tr_max_slot: 1,
        tr_time: 1,
        tr_poster: "",
        tr_location: 0,
        tr_listDestinations: [],
        tr_listTouristRouteDetails: [],
        tr_fileList: []
      })
    };
  },
  methods: {
    changeTime() {
      this.form.tr_listTouristRouteDetails = [];
      for (let index = 0; index < this.form.tr_time; index++) {
        this.form.tr_listTouristRouteDetails[index] = {
          trd_date: index + 1,
          trd_description: ""
        };
      }
    },
    uploadImageSuccess(formData, index, fileList) {
      console.log("data", formData, index, fileList);
      // Upload image api
      this.form.tr_fileList = fileList;
      //   axios
      //     .post(this.$Api + "/tourist-route/image/add/1", fileList)
      //     .then(response => {
      //       console.log(response);
      //     });
    },
    beforeRemove(index, done, fileList) {
      console.log("index", index, fileList);
      var r = confirm("remove image");
      if (r == true) {
        done();
      } else {
      }
      this.form.tr_fileList = fileList;
    },
    editImage(formData, index, fileList) {
      console.log("edit data", formData, index, fileList);
      this.form.tr_fileList = fileList;
    },
    onSearchLocation(search, loading) {
      loading(true);
      this.search(loading, search, this);
    },
    search: _.debounce((loading, search, vm) => {
      fetch(vm.$Api + `/location/select/search?q=${search}`).then(res => {
        res.json().then(json => {
          vm.locations = json;
          console.log(escape(search));
        });
        loading(false);
      });
    }, 350),
    loadListLocations() {
      axios.get(this.$Api + "/location/select/search?q=").then(response => {
        this.locations = response.data;
      });
    },
    loadListCategories() {
      axios.get(this.$Api + "/category/get/all").then(response => {
        this.categories = response.data;
      });
    },
    chooseImage() {
      this.$refs.tr_poster.click();
    },
    getImageModal() {
      let tr_poster = "";
      if (this.form.tr_poster.length != 0) {
        tr_poster =
          this.form.tr_poster.length > 200
            ? this.form.tr_poster
            : this.$Host + "/img/tourist-route/" + this.form.tr_poster;
      } else {
        tr_poster = this.$Host + "/assets/media/img/new_seo-10-75.png";
      }
      return tr_poster;
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
        this.form.tr_poster = reader.result;
      };
      reader.readAsDataURL(file);
    },
    create() {
      this.$Progress.start();
      this.form
        .post(this.$Api + "/tourist-route")
        .then(response => {
          console.log(response);
          Toast.fire({
            type: "success",
            title: "Tạo mới thành công!"
          });
          this.$Progress.finish();
          //this.form.reset();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    update() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put(this.$Api + "/tourist-route/" + this.form.tr_id)
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
    }
  },
  created() {
    this.loadListCategories();
    this.loadListLocations();
    this.changeTime();
  }
};
</script>