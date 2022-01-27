<template>
  <button
    :class="`btn btn-block d-flex justify-content-center ${
      licensing ? 'btn-warning text-white' : 'btn-custom'
    }`"
    @click="download"
  >
    <span v-if="!loading">Download ({{ size }} mb)</span>
    <epic-spinner v-else :type="2" class="my-1"></epic-spinner>
  </button>
</template>

<script>
import EpicSpinner from "../loading/Loading.vue";
export default {
  components: { EpicSpinner },
  props: ["size", "licensing", "asset"],
  data() {
    return {
      loading: false,
      user: null,
    };
  },

  methods: {
    async download() {
      this.loading = true;
      this.user = document
        .querySelector("meta[name='user-id']")
        .getAttribute("content");

      if (!this.user) window.location.href = "/login";

      let response = await axios.get(`/api/asset/${this.asset}/download`, {
        params: { boot: this.user },
      });
      if ((response.status = 200)) {
        this.loading = false;
      }
    },
  },
};
</script>

<style>
</style>