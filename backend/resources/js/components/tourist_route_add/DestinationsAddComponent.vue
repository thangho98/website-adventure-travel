<template>
  <tr>
    <td class="text-center">
      <v-select
        required
        :filterable="false"
        @search="onSearchLocation"
        :options="locations"
        label="loca_name"
        :reduce="location => location.loca_id"
        v-model="loca.loca_id"
        @input="updateData"
      >
        <template slot="no-options">Chọn một địa điểm</template>
        <template slot="option" slot-scope="location">
          <div class="d-center">{{ location.loca_name }}</div>
        </template>
        <template slot="selected-option" slot-scope="location">
          <div class="selected d-center">{{ location.loca_name }}</div>
        </template>
      </v-select>
    </td>
    <td class="text-left">
      <button
        type="button"
        @click="close"
        data-toggle="tooltip"
        class="btn btn-danger"
        title="Loại bỏ"
      >
        <i class="fa fa-minus-circle"></i>
      </button>
    </td>
  </tr>
</template>

<script>
export default {
  data() {
    return {
      locations: []
    };
  },
  props: {
    listDestinations: null,
    index: Number,
    loca: {}
  },
  methods: {
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
    close() {
      console.log(this.listDestinations);
      //delete this.listDestinations[this.index];
      this.listDestinations.splice(this.index, 1);
      console.log(this.listDestinations);

      this.$emit("update:form.tr_listDestinations", this.listDestinations);
      // // destroy the vue listeners, etc
      // this.$destroy();

      // // remove the element from the DOM
      // this.$el.parentNode.removeChild(this.$el);
    },
    updateData() {
      this.$emit(`update:form.tr_listDestinations[${this.index}]`, this.loca);
    }
  },
  created() {
    this.loadListLocations();
  }
};
</script>
