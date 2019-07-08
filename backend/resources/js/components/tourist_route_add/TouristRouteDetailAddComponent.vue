<template>
  <tr>
    <td class="text-left">
      <input
        v-model="trd.trd_date"
        type="number"
        name="trd_date"
        class="form-control text-center"
        readonly
      />
    </td>
    <td class="text-left">
      <input
        v-model="trd.trd_title"
        type="text"
        name="trd_title"
        class="form-control"
        required
        @keyup="updateData"
      />
    </td>
    <td class="text-left">
      <textarea
        v-model="trd.trd_description"
        type="text"
        name="trd_description"
        class="form-control"
        required
        @keyup="updateData"
      ></textarea>
    </td>
  </tr>
</template>

<script>
export default {
  data() {
    return {};
  },
  props: {
    index: Number,
    trd: {}
  },
  methods: {
    updateData() {
      this.$emit(
        `update:form.tr_listTouristRouteDetails[${this.index}]`,
        this.trd
      );
    }
  },
  created() {}
};
</script>
