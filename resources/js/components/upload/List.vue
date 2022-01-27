<template>
  <div class="container">
    <div class="header d-flex justify-content-between mb-3">
      <h5 class="align-self-center">Upload List</h5>
      <form action="" style="width: 150px">
        <select name="" id="" class="custom-select">
          <option disabled selected>Filter</option>
          <option value="">Newest</option>
          <option value="">Oldes</option>
        </select>
      </form>
    </div>
    <div class="card card-body">
      <table class="table mb-0">
        <tr v-if="loading.skeleton1">
          <td>
            <v-skeleton-loader
              class="mx-auto"
              max-width="50"
              type="text"
            ></v-skeleton-loader>
          </td>
          <td>
            <v-skeleton-loader
              width="400"
              type="list-item-two-line"
            ></v-skeleton-loader>
          </td>
          <td>
            <v-skeleton-loader width="200" type="list-item"></v-skeleton-loader>
          </td>
          <td class="d-flex align-items-center justify-content-center">
            <v-skeleton-loader
              class="mx-auto"
              max-width="100%"
              type="avatar"
            ></v-skeleton-loader>
            <v-skeleton-loader
              class="mx-auto"
              max-width="100%"
              type="avatar"
            ></v-skeleton-loader>
          </td>
        </tr>
        <tr v-else v-for="(item, index) in uploadList.data" :key="item.id">
          <th>{{ ++index }}</th>
          <td>
            <a
              :href="`/asset/${item.asset.slug}/detail`"
              class="text-decoration-none"
            >
              <p class="font-weight-bold my-0">{{ item.asset.name }}</p>
              <small class="text-primary">{{ item.asset.created_at }}</small>
            </a>
          </td>
          <td>{{ item.software.name }}</td>
          <td class="text-center">
            <button class="btn btn-primary rounded-pill mr-1">
              <i class="fas fa-pencil-alt"></i>
            </button>
            <button
              class="btn btn-custom-danger rounded-pill"
              @click="deleteData(item.id)"
            >
              <i class="fas fa-times"></i>
            </button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import pagination from "laravel-vue-pagination";
import "../../vendor.js";
export default {
  components: { pagination },
  data() {
    return {
      uploadList: {},
      loading: { epic: false, skeleton1: false, skeleton2: false },
      keywords: null,
      secretId: null,
    };
  },

  beforeMount() {
    this.getData();
  },

  methods: {
    async getData(page = 1) {
      this.loading.skeleton1 = true;
      this.secretId = document
        .querySelector("meta[name='user-id']")
        .getAttribute("content");
      let response = await axios.get(`/api/asset/list?page=${page}`, {
        params: { keywords: this.keywords, user: this.secretId },
      });
      if (response.status == 200) {
        this.loading.skeleton1 = false;
        this.uploadList = response.data;
      }
    },

    deleteData(data) {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#7f7f7f",
        cancelButtonColor: "#cdd3d8",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/api/asset/${data}/delete`).then((response) => {
            if (response.status == 200) {
              this.getData();
              this.$toast.success(`Your asset has been deleted`);
            }
          });
        }
      });
    },
  },
};
</script>

<style>
</style>