<style lang="scss" scoped>
</style>  
<template>
  <!-- Main Container -->
  <main id="main-container">
    <!-- Hero -->
    <div class="bg-image" :style="getBackground()">
      <div class="bg-black-50">
        <div class="content content-full text-center">
          <div class="my-3">
            <img class="img-avatar img-avatar-thumb" :src="getProfilePhoto()" alt />
          </div>
          <h1 class="h2 text-white mb-0">{{this.form.name}}</h1>
          <span class="text-white-75">{{this.form.type}}</span>
        </div>
      </div>
    </div>
    <!-- END Hero -->

    <!-- Stats -->
    <div class="bg-white border-bottom">
      <div class="content content-boxed">
        <div class="row items-push text-center">
          <div class="col-6 col-md-3">
            <div class="font-size-sm font-w600 text-muted text-uppercase">Sales</div>
            <a class="link-fx font-size-h3" href="javascript:void(0)">17980</a>
          </div>
          <div class="col-6 col-md-3">
            <div class="font-size-sm font-w600 text-muted text-uppercase">Products</div>
            <a class="link-fx font-size-h3" href="javascript:void(0)">27</a>
          </div>
          <div class="col-6 col-md-3">
            <div class="font-size-sm font-w600 text-muted text-uppercase">Followers</div>
            <a class="link-fx font-size-h3" href="javascript:void(0)">1360</a>
          </div>
          <div class="col-6 col-md-3">
            <div class="font-size-sm font-w600 text-muted text-uppercase mb-2">739 Ratings</div>
            <span class="text-warning">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-half"></i>
            </span>
            <span class="font-size-sm text-muted">(4.9)</span>
          </div>
        </div>
      </div>
    </div>
    <!-- END Stats -->

    <!-- Page Content -->
    <div class="content">
      <!-- Full Table -->
      <div class="block">
        <div class="block-content">
          <div class="row">
            <div class="col-md-12">
              <div class="block">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="#btabsactivity" data-toggle="tab">Hoạt động</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link active" href="#btabsprofile" data-toggle="tab">Hồ Sơ</a>
                  </li>
                  <li class="nav-item ml-auto">
                    <a
                      data-toggle="tab"
                      title="Thay đổi mật khẩu"
                      class="nav-link"
                      href="#btabssetting"
                    >
                      <i class="si si-settings"></i>
                    </a>
                  </li>
                </ul>
                <div class="block-content tab-content overflow-hidden">
                  <div class="tab-pane fade fade-right" id="btabsactivity" role="tabpanel">
                    <h4 class="font-w400">Hoạt động</h4>
                    <p>Display User Activity.</p>
                  </div>
                  <div
                    class="tab-pane fade fade-right show active"
                    id="btabsprofile"
                    role="tabpanel"
                  >
                    <h4 class="font-w400">Thông tin hồ sơ</h4>
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                          <input
                            type
                            v-model="form.name"
                            class="form-control"
                            id="inputName"
                            placeholder="Name"
                            :class="{ 'is-invalid': form.errors.has('name') }"
                          />
                          <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                          <input
                            type="email"
                            v-model="form.email"
                            class="form-control"
                            id="inputEmail"
                            placeholder="Email"
                            :class="{ 'is-invalid': form.errors.has('email') }"
                          />
                          <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-12">
                          <textarea
                            v-model="form.bio"
                            class="form-control"
                            id="inputExperience"
                            placeholder="Experience"
                            :class="{ 'is-invalid': form.errors.has('bio') }"
                          ></textarea>
                          <has-error :form="form" field="bio"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                        <div class="col-sm-12">
                          <input
                            type="file"
                            accept="image/*"
                            name="photo"
                            @change="updateProfile"
                            class="form-input"
                          />
                        </div>
                      </div>

                      <!-- <div class="form-group">
                          <label
                            for="password"
                            class="col-sm-12 control-label"
                          >Passport (leave empty if not changing)</label>

                          <div class="col-sm-12">
                            <input
                              type="password"
                              v-model="form.password"
                              class="form-control"
                              id="password"
                              placeholder="Passport"
                              :class="{ 'is-invalid': form.errors.has('password') }"
                            >
                            <has-error :form="form" field="password"></has-error>
                          </div>
                      </div>-->

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                          <button
                            @click.prevent="updateInfo"
                            type="submit"
                            class="btn btn-success"
                          >Cập nhật</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade fade-right" id="btabssetting" role="tabpanel">
                    <h4 class="font-w400">Thay đổi mật khẩu</h4>
                    <form class="form-horizontal">
                      <div class="row justify-content-center mt-5">
                        <div class="col-lg-8 col-xl-5">
                          <div class="form-group">
                            <label for="old_password" class="col-sm-12 control-label">Mật khẩu cũ</label>
                            <input
                              type="password"
                              v-model="formPas.old_password"
                              class="form-control"
                              id="old_password"
                              :class="{ 'is-invalid': formPas.errors.has('old_password') }"
                            />
                            <has-error :form="formPas" field="old_password"></has-error>
                          </div>
                          <div class="form-group">
                            <label for="password" class="col-sm-12 control-label">Mật khẩu mới</label>
                            <input
                              type="password"
                              v-model="formPas.password"
                              class="form-control"
                              id="password"
                              :class="{ 'is-invalid': formPas.errors.has('password') }"
                            />
                            <has-error :form="formPas" field="password"></has-error>
                          </div>
                          <div class="form-group">
                            <label
                              for="password_confirmation"
                              class="col-sm-12 control-label"
                            >Xác nhận mật khẩu mới</label>
                            <input
                              type="password"
                              v-model="formPas.password_confirmation"
                              class="form-control"
                              id="password_confirmation"
                              :class="{ 'is-invalid': formPas.errors.has('password_confirmation') }"
                            />
                            <has-error :form="formPas" field="password_confirmation"></has-error>
                          </div>
                          <div class="form-group">
                            <button
                              id="btnReset"
                              class="btn btn-danger mr-3"
                              type="submit"
                              @click.prevent="changPassword()"
                            >Thay đổi mật khẩu</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.nav-tabs-custom -->
            </div>
          </div>
        </div>
      </div>
      <!-- END Full Table -->
    </div>
    <!-- END Page Content -->
  </main>
  <!-- END Main Container -->
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: ""
      }),
      formPas: new Form({
        old_password: "",
        password: "",
        password_confirmation: ""
      })
    };
  },
  methods: {
    getBackground() {
      return (
        "background-image: url('" +
        this.$Host +
        "/assets/media/photos/photo8@2x.jpg');"
      );
    },
    getProfilePhoto() {
      let photo =
        this.form.photo.length > 200
          ? this.form.photo
          : this.$Host + "/img/profile/" + this.form.photo;
      return photo;
    },
    changPassword() {
      this.$Progress.start();
      this.formPas
        .put(this.$Api + "/profile/changepassword")
        .then(() => {
          Fire.$emit("AfterCreate");
          this.$Progress.finish();
          Toast.fire({
            type: "success",
            title: "Mật khẩu đã được cập nhật."
          });
          this.formPas.reset();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateInfo() {
      this.$Progress.start();
      if (this.form.password == "") {
        this.form.password = undefined;
      }
      this.form
        .put(this.$Api + "/profile")
        .then(() => {
          Fire.$emit("AfterCreate");
          this.$Progress.finish();
          Toast.fire({
            type: "success",
            title: "Thông tin đã được cập nhật."
          });
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateProfile(e) {
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
        this.form.photo = reader.result;
      };
      reader.readAsDataURL(file);
    }
  },
  created() {
    axios.get(this.$Api + "/profile").then(({ data }) => this.form.fill(data));
  }
};
</script>
