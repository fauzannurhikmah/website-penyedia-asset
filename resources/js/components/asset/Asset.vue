<template>
  <section class="section">
    <div class="section-header">
      <h1>Asset</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Assets</div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4>Asset List</h4>
        <div class="card-header-form mr-2">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" />
              <div class="input-group-btn">
                <button class="btn btn-custom">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        <button class="btn btn-custom"><i class="fas fa-filter"></i></button>
      </div>
      <div class="card-body p-0">
        <table class="table" id="dataTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Asset Name</th>
              <th scope="col">Software</th>
              <th scope="col">Creator</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Skeleton loader -->
            <tr v-if="loading.skeleton1">
              <td>
                <v-skeleton-loader
                  class="mx-auto"
                  width="20"
                  type="text"
                ></v-skeleton-loader>
              </td>
              <td>
                <v-skeleton-loader
                  width="200"
                  type="list-item"
                ></v-skeleton-loader>
              </td>
              <td>
                <v-skeleton-loader
                  width="200"
                  type="list-item"
                ></v-skeleton-loader>
              </td>
              <td>
                <v-skeleton-loader
                  width="200"
                  type="list-item"
                ></v-skeleton-loader>
              </td>
              <td class="d-flex justify-content-center">
                <v-skeleton-loader type="actions"></v-skeleton-loader>
              </td>
            </tr>
            <tr v-else v-for="(asset, index) in assetList.data" :key="asset.id">
              <th scope="row">{{ ++index }}</th>
              <td>{{ asset.name }}</td>
              <td>{{ asset.detail[0].software.name }}</td>
              <td>{{ asset.detail[0].user.username }}</td>
              <td class="text-center">
                <a
                  :href="`/admin/asset/${asset.slug}/detail`"
                  class="btn btn-outline-info border-0 mr-2 shadow-sm"
                  ><i class="fas fa-eye"></i
                ></a>
                <button class="btn btn-outline-danger border-0 shadow-sm">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
            <!-- empty list -->
            <tr v-if="!loading.skeleton1 && !assetList.data.length">
              <td colspan="6" class="text-center text-info font-weight-bold">
                Empty !
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          align="center"
          :data="assetList"
          @pagination-change-page="getData"
        ></pagination>
      </div>
    </div>
  </section>
</template>

<script>
import pagination from "laravel-vue-pagination";
import EpicSpinner from "../loading/Loading.vue";
import "../../vendor.js";
export default {
  components: { EpicSpinner, pagination },
  data() {
    return {
      assetList: {},
      loading: { epic: false, skeleton1: false, skeleton2: false },
    };
  },
  beforeMount() {
    this.getData();
  },

  methods: {
    async getData(page = 1) {
      this.loading.skeleton1 = true;
      let response = await axios.get(`/api/asset?page=${page}`);
      if (response.status == 200) {
        this.loading.skeleton1 = false;
        this.assetList = response.data;
      }
    },
  },
};
</script>
