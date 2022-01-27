vu<template>
  <div>
    <section class="section">
      <div class="section-header">
        <h1>Render Engine</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Render Engine</div>
        </div>
      </div>
    </section>
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h4>Render Engine List</h4>
        <div class="card-header-form mr-2">
          <form>
            <div class="input-group">
              <input
                type="text"
                v-model="keywords"
                class="form-control"
                placeholder="Search"
              />
              <div class="input-group-btn">
                <button class="btn btn-custom">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        <button
          class="btn btn-custom"
          data-toggle="modal"
          data-target="#popUpModal"
        >
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <div class="card-body p-0">
        <table class="table" id="dataTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Render Engine</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
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
                  width="500"
                  type="list-item"
                ></v-skeleton-loader>
              </td>
              <td class="d-flex justify-content-center">
                <v-skeleton-loader type="actions"></v-skeleton-loader>
              </td>
            </tr>
            <tr
              v-else
              v-for="(render, index) in renderList.data"
              :key="render.id"
            >
              <th scope="row">{{ ++index }}</th>
              <td>{{ render.name }}</td>
              <td class="text-center">
                <button
                  class="btn btn-outline-secondary border-0 mr-2 shadow-sm"
                  data-toggle="modal"
                  :data-target="`#${render.slug}`"
                  @click="dataForEdit(render.slug)"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button
                  class="btn btn-outline-danger border-0 shadow-sm"
                  @click="deleteData(render)"
                >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>

            <!-- empty list -->
            <tr v-if="!loading.skeleton1 && !renderList.data.length">
              <td colspan="3" class="text-center text-info font-weight-bold">
                Empty !
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          align="center"
          :data="renderList"
          @pagination-change-page="getData"
        ></pagination>
      </div>
    </div>

    <!-- Edit Modal -->
    <div v-for="render in renderList.data" :key="render.id">
      <div
        class="modal fade"
        :id="`${render.slug}`"
        tabindex="-1"
        aria-labelledby="popUpModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="popUpModalLabel">Edit Render</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="edit(render)">
              <div class="modal-body">
                <div class="form-group">
                  <label for="category">Render Engine Name</label>
                  <!-- Skeleton loader -->
                  <v-skeleton-loader
                    v-if="loading.skeleton2"
                    class="mx-auto"
                    max-width="100%"
                    type="list-item"
                  ></v-skeleton-loader>
                  <input
                    v-else
                    type="text"
                    v-model="renderUpdate.name"
                    id="category"
                    class="form-control"
                  />
                  <small class="text-danger" v-if="theErrors.render">
                    {{ theErrors.render[0] }}</small
                  >
                </div>
                <div class="form-group d-flex justify-content-end mb-0">
                  <button type="submit" class="btn btn-custom d-flex">
                    <span>Update</span
                    ><epic-spinner
                      class="ml-2"
                      :type="1"
                      v-if="loading.epic"
                    ></epic-spinner>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Create Modal -->
    <div
      class="modal fade"
      id="popUpModal"
      tabindex="-1"
      aria-labelledby="popUpModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="popUpModalLabel">
              Create New Render Engine
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="create">
            <div class="modal-body">
              <div class="form-group">
                <label for="category">Render Engine Name</label>
                <input
                  type="text"
                  v-model="render"
                  id="category"
                  class="form-control"
                />
                <small class="text-danger" v-if="theErrors.render">
                  {{ theErrors.render[0] }}</small
                >
              </div>
              <div class="form-group d-flex justify-content-end mb-0">
                <button type="submit" class="btn btn-custom d-flex">
                  <span>Save</span
                  ><epic-spinner
                    class="ml-2"
                    :type="1"
                    v-if="this.loading.epic"
                  ></epic-spinner>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import pagination from "laravel-vue-pagination";
import EpicSpinner from "../loading/Loading.vue";
import "../../vendor.js";
export default {
  components: { EpicSpinner, pagination },
  data() {
    return {
      render: "",
      loading: { epic: false, skeleton1: false, skeleton2: false },
      renderUpdate: [],
      renderList: {},
      theErrors: [],
      keywords: null,
    };
  },

  beforeMount() {
    this.getData();
  },

  watch: {
    keywords(after, before) {
      this.getData();
    },
  },

  methods: {
    async getData(page = 1) {
      this.loading.skeleton1 = true;
      let response = await axios.get(`/api/render?page=${page}`, {
        params: { keywords: this.keywords },
      });
      if (response.status == 200) {
        this.loading.skeleton1 = false;
        this.renderList = response.data;
      }
    },

    async create() {
      this.loading.epic = true;
      try {
        let response = await axios.post("/api/render/create", {
          render: this.render,
        });
        if (response.status == 200) {
          this.getData();
          this.loading.epic = false;
          this.render = "";
          this.$toast.success(
            `Render ${response.data.name} added successfully`
          );
          this.theErrors = [];
        }
      } catch (e) {
        this.loading.epic = false;
        this.theErrors = e.response.data.errors;
        this.$toast.error("Something went wrong");
      }
    },

    async dataForEdit(data) {
      this.theErrors = [];
      this.loading.skeleton2 = true;
      let response = await axios.get(`/api/render/${data}/get`);
      if (response.status == 200) {
        this.renderUpdate = response.data;
        this.loading.skeleton2 = false;
      }
    },

    async edit(data) {
      this.loading.epic = true;
      try {
        let response = await axios.put(`/api/render/${data.slug}/update`, {
          render: this.renderUpdate.name,
        });
        if (response.status == 200) {
          this.getData();
          this.loading.epic = false;
          this.$toast.success(`${data.name} render has been updated`);
        }
      } catch (e) {
        this.loading.epic = false;
        this.theErrors = e.response.data.errors;
        this.$toast.error("Something went wrong");
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
          axios.delete(`/api/render/${data.slug}/delete`).then((response) => {
            if (response.status == 200) {
              this.getData();
              this.$toast.success(`${data.name} Render has been deleted`);
            }
          });
        }
      });
    },
  },
};
</script>
