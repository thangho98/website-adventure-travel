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
            Developer
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
            ></small>
          </h1>
          <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">Hệ Thống</li>
              <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href>Developer</a>
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
      <div class="block">
        <div class="block-content">
          <passport-clients></passport-clients>
        </div>
      </div>
    </div>
    <!-- <div class="content">
      <div class="block">
        <div class="block-content">
          <passport-authorized-clients></passport-authorized-clients>
        </div>
      </div>
    </div>-->
    <div class="content">
      <div class="block">
        <div class="block-content">
          <passport-personal-access-tokens></passport-personal-access-tokens>
        </div>
      </div>
    </div>
    <!-- END Page Content -->
    <div v-if="!$gate.isAdminOrAuthor()">
      <not-found></not-found>
    </div>
  </main>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
