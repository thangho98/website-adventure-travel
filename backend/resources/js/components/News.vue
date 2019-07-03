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
            >Danh sách tin tức</small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Quản lý</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Tin tức</a>
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
            <router-link to="/admin/news/add" class="btn btn-success">
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
                  <th>Tiêu đề</th>
                  <th>Ảnh bìa</th>
                  <th>Mô tả</th>
                  <th>Người đăng bài</th>
                  <th>Thời gian đăng bài</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="newz in newzs.data" :key="newz.news_id">
                  <td>{{newz.news_id}}</td>
                  <td>{{newz.news_title}}</td>
                  <td v-if="newz.news_poster.length > 0">
                    <a data-fancybox="gallery" :href="loadImage(newz.news_poster)">
                      <img
                        class="thumbnail"
                        :src="loadImage(newz.news_poster)"
                        height="75px;"
                        width="150px;"
                      />
                    </a>
                  </td>
                  <td v-else class="font-w600 font-size-sm">Chưa có ảnh bìa</td>
                  <td>{{newz.news_description}}</td>
                  <td>{{newz.name}}</td>
                  <td>{{newz.news_time_post | myDate}}</td>
                  <td class="text-center">
                    <router-link
                      v-if="$gate.getID() == newz.id"
                      :to="{ name:'editNews', params: { news_id: newz.news_id } }"
                    >
                      <i class="fa fa-edit blue"></i>
                    </router-link>
                    <a v-else href="#" disabled>
                      <i class="fa fa-edit blue"></i>
                    </a>/
                    <a href="#" @click="deleteObject(newz.news_id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <pagination :data="newzs" @pagination-change-page="getResults"></pagination>
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
      newzs: {},
      form: new Form({})
    };
  },
  methods: {
    loadImage(imageName) {
      return this.$Host + "/img/news/" + imageName;
    },
    getResults(page = 1) {
      axios.get(this.$Api + "/news?page=" + page).then(response => {
        this.newzs = response.data;
      });
    },
    loadData() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get(this.$Api + "/news").then(({ data }) => (this.newzs = data));
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
            .delete(this.$Api + "/news/" + id)
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
