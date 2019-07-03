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
            Tin tức
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            >Cập nhật tin tức</small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Nhân viên</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Tin tức</a>
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
            <h3 class="block-title">1. Thông tin bài đăng</h3>
          </div>
          <div class="block-content block-content-full">
            <div class="row">
              <div class="col-md-12">
                <div class="form-row">
                  <div class="form-group col-12">
                    <label for>
                      Tiêu đề
                      <span class="text-danger">*</span>
                    </label>
                    <input
                      v-model="form.news_title"
                      type="text"
                      name="news_title"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('news_title') }"
                      placeholder="Tiêu đề"
                    />
                    <has-error :form="form" field="news_title"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-12">
                    <label for>
                      Mô tả
                      <span class="text-danger">*</span>
                    </label>
                    <textarea
                      v-model="form.news_description"
                      name="news_description"
                      class="form-control"
                      placeholder="mô tả"
                      :class="{ 'is-invalid': form.errors.has('news_description') }"
                    ></textarea>
                    <has-error :form="form" field="news_description"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-6">
                    <label for>
                      Ảnh bìa
                      <span class="text-danger">*</span>
                    </label>
                    <br />
                    <input
                      hidden
                      id="news_poster"
                      ref="news_poster"
                      type="file"
                      accept="image/*"
                      name="news_poster"
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
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <!-- Full Table -->
        <div class="block">
          <div class="block-header">
            <h3 class="block-title">2. Nội dung bài đăng</h3>
          </div>
          <div class="block-content block-content-full">
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
                <ckeditor
                  id="editor"
                  :editor="editor"
                  v-model="form.news_content"
                  :config="editorConfig"
                ></ckeditor>
                <has-error :form="form" field="news_content"></has-error>
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
                  @click.prevent="update()"
                  class="btn btn-success ml-2"
                  data-wizard="finish"
                >
                  <i class="fa fa-check ml-1"></i> Cập nhật
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import CKEditor from "@ckeditor/ckeditor5-vue";
export default {
  name: "Editor",
  components: {
    // Use the <ckeditor> component in this view.
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        toolbar: {
          items: [
            "ckfinder",
            "heading",
            "|",
            "bold",
            "italic",
            "|",
            "numberedList",
            "bulletedList",
            "|",
            "link",
            "blockquote",
            "imageUpload",
            "insertTable",
            "mediaEmbed",
            "|",
            "undo",
            "redo"
          ]
        },
        heading: {
          options: [
            {
              model: "paragraph",
              title: "Paragraph",
              class: "ck-heading_paragraph"
            },
            {
              model: "heading1",
              view: "h1",
              title: "Heading 1",
              class: "ck-heading_heading1"
            },
            {
              model: "heading2",
              view: "h2",
              title: "Heading 2",
              class: "ck-heading_heading2"
            },
            {
              model: "heading3",
              view: "h3",
              title: "Heading 3",
              class: "ck-heading_heading3"
            },
            {
              model: "heading4",
              view: "h4",
              title: "Heading 4",
              class: "ck-heading_heading4"
            },
            {
              model: "heading5",
              view: "h5",
              title: "Heading 5",
              class: "ck-heading_heading5"
            },
            {
              model: "heading6",
              view: "h6",
              title: "Heading 6",
              class: "ck-heading_heading6"
            }
          ]
        },
        ckfinder: {
          uploadUrl:
            "/ckfinder/connector?command=QuickUpload&type=Images&responseType=json",
          options: {
            connectorPath: "/ckfinder/connector"
          }
        }
      },
      form: new Form({
        news_id: this.$route.params.news_id,
        news_title: "",
        news_description: "",
        news_poster: "",
        news_content: ""
      })
    };
  },
  methods: {
    loadData() {
      axios.get(this.$Api + "/news/" + this.form.news_id).then(response => {
        this.form.fill(response.data);
      });
    },
    chooseImage() {
      this.$refs.news_poster.click();
    },
    getImageModal() {
      let news_poster = "";
      if (this.form.news_poster.length != 0) {
        news_poster =
          this.form.news_poster.length > 200
            ? this.form.news_poster
            : this.$Host + "/img/news/" + this.form.news_poster;
      } else {
        news_poster = this.$Host + "/assets/media/img/new_seo-10-75.png";
      }
      return news_poster;
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
        this.form.news_poster = reader.result;
      };
      reader.readAsDataURL(file);
    },
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
                this.$router.push("/admin/news");
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
    update() {
      this.$Progress.start();
      this.form
        .put(this.$Api + "/news/" + this.form.news_id)
        .then(response => {
          console.log(response);
          Toast.fire({
            type: "success",
            title: "Tạo mới thành công!"
          });
          this.$Progress.finish();
          this.form.reset();
          this.$router.push("/admin/news");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    }
  },
  created() {
    this.loadData();
  }
};
</script>