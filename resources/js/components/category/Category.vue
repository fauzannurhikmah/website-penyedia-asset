<template>
  <div>
    <section class="section">
      <div class="section-header">
        <h1>Category</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Category</div>
        </div>
      </div>
    </section>

    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h4>Category List</h4>
        <div class="card-header-form mr-2">
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              placeholder="Search"
              v-model="keywords"
            />
            <div class="input-group-btn">
              <button class="btn btn-custom">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
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
              <th scope="col">Thumbnail</th>
              <th scope="col">Name</th>
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
                  width="80"
                  height="50"
                  type="image"
                ></v-skeleton-loader>
              </td>
              <td>
                <v-skeleton-loader
                  width="300"
                  type="list-item"
                ></v-skeleton-loader>
              </td>
              <td class="d-flex justify-content-center">
                <v-skeleton-loader type="actions"></v-skeleton-loader>
              </td>
            </tr>
            <tr
              v-else
              v-for="(category, index) in categoryList.data"
              :key="category.id"
            >
              <th scope="row">{{ ++index }}</th>
              <td>
                <img
                  :src="`/storage/${category.thumbnail}`"
                  alt=""
                  width="80"
                  class="rounded shadow-sm"
                  loading="lazy"
                />
              </td>
              <td>{{ category.name }}</td>
              <td class="text-center">
                <button
                  class="btn btn-outline-secondary border-0 mr-2 shadow-sm"
                  data-toggle="modal"
                  :data-target="`#${category.slug}`"
                  @click="dataForEdit(category.slug)"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button
                  class="btn btn-outline-danger border-0 shadow-sm"
                  @click="deleteData(category)"
                >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
            <!-- empty list -->
            <tr v-if="!loading.skeleton1 && !categoryList.data.length">
              <td colspan="4" class="text-center text-info font-weight-bold">
                Empty !
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          align="center"
          :data="categoryList"
          @pagination-change-page="getData"
        ></pagination>
      </div>
    </div>

    <!-- edit modal -->
    <div v-for="category in categoryList.data" :key="category.id">
      <div
        class="modal fade"
        :id="category.slug"
        tabindex="-1"
        aria-labelledby="popUpModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="popUpModalLabel">Edit Category</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="edit(category)">
              <div class="modal-body">
                <div class="form-group text-left">
                  <label for="category">Category</label>
                  <!-- Skeleton loader -->
                  <v-skeleton-loader
                    v-if="loading.skeleton2"
                    class="mx-auto"
                    max-width="100%"
                    type="list-item"
                  ></v-skeleton-loader>
                  <input
                    type="text"
                    v-model="categoryUpdate.name"
                    id="category"
                    class="form-control"
                    v-else
                  />
                  <small class="text-danger" v-if="theErrors.category">
                    {{ theErrors.category[0] }}</small
                  >
                </div>
                <div class="form-group text-left">
                  <label for="thumbnail">Thumbnail</label>
                  <input
                    type="file"
                    @change="thumbnailPreview"
                    id="category"
                    class="form-control"
                  />
                  <small class="text-danger" v-if="theErrors.thumbnail">
                    {{ theErrors.thumbnail[0] }}</small
                  >
                  <div class="row justify-content-center mt-3">
                    <div class="col text-center">
                      <p class="mb-0 text-primary font-weight-light">
                        Thumbnail use
                      </p>
                      <v-skeleton-loader
                        v-if="loading.skeleton2"
                        class="mx-auto"
                        max-width="80%"
                        max-height="120"
                        type="image"
                      ></v-skeleton-loader>
                      <img
                        v-else
                        :src="`/storage/${categoryUpdate.thumbnail}`"
                        class="rounded shadow-sm"
                        width="150"
                      />
                    </div>
                    <div class="col text-center">
                      <div v-if="livePreview">
                        <p class="mb-0 text-primary font-weight-light">
                          New Thumbnail
                        </p>
                        <img
                          :src="livePreview"
                          class="rounded shadow-sm"
                          width="150"
                        />
                      </div>
                    </div>
                  </div>
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
    <!-- end tag edit modal -->

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
            <h5 class="modal-title" id="popUpModalLabel">Create Category</h5>
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
                <label for="category">Category</label>
                <input
                  type="text"
                  v-model="category"
                  id="category"
                  class="form-control"
                />
                <small class="text-danger" v-if="theErrors.category">
                  {{ theErrors.category[0] }}</small
                >
              </div>
              <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input
                  type="file"
                  @change="thumbnailPreview"
                  id="category"
                  class="form-control"
                />
                <small class="text-danger" v-if="theErrors.thumbnail">
                  {{ theErrors.thumbnail[0] }}</small
                >
                <div class="mt-3 text-center" v-if="livePreview">
                  <p class="mb-0 text-primary font-weight-light">
                    Image Preview
                  </p>
                  <img
                    :src="livePreview"
                    class="rounded shadow-sm mx-auto"
                    width="150"
                  />
                </div>
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
    <!-- end create modal -->
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
      loading: { epic: false, skeleton1: false, skeleton2: false },
      category: "",
      categoryUpdate: [],
      theErrors: [],
      categoryList: {},
      keywords: null,
      thumbnail: null,
      livePreview: null,
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
    thumbnailPreview(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.livePreview = e.target.result;
        };
        this.thumbnail = input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },
    async getData(page = 1) {
      this.loading.skeleton1 = true;
      let response = await axios.get(`/api/category?page=${page}`, {
        params: { keywords: this.keywords },
      });
      if (response.status == 200) {
        this.loading.skeleton1 = false;
        this.categoryList = response.data;
      }
    },

    async create() {
      try {
        let formData = new FormData();
        formData.append("thumbnail", this.thumbnail);
        formData.append("category", this.category);
        const config = { headers: { "Content-Type": "multipart/form-data" } };
        this.loading.epic = true;
        let response = await axios.post(
          `/api/category/create`,
          formData,
          config
        );
        if (response.status == 200) {
          this.getData();
          this.loading.epic = false;
          this.category = this.livePreview = this.thumbnail = "";
          this.$toast.success(
            `Category ${response.data.name} added successfully`
          );
          this.theErrors = [];
        }
      } catch (e) {
        this.loading.epic = false;
        this.theErrors = e.response.data.errors;
        this.$toast.error("Something went wrong");
      }
    },

    async edit(data) {
      this.loading.epic = true;
      try {
        let formData = new FormData();
        formData.append("thumbnail", this.thumbnail);
        formData.append("category", this.categoryUpdate.name);

        console.log(this.categoryUpdate.name);
        console.log(this.thumbnail);
        const config = { headers: { "Content-Type": "multipart/form-data" } };
        let response = await axios.put(
          `/api/category/${data.slug}/update`,
          formData,
          config
        );
        if (response.status == 200) {
          this.getData();
          this.loading.epic = false;
          this.livePreview = "";
          this.$toast.success(
            `${response.data.name} category has been updated`
          );
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
      this.livePreview = this.thumbnail = "";
      let response = await axios.get(`/api/category/${data}/get`);
      if (response.status == 200) {
        this.categoryUpdate = response.data;
        this.loading.skeleton2 = false;
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
          axios.delete(`/api/category/${data.slug}/delete`).then((response) => {
            if (response.status == 200) {
              this.getData();
              this.$toast.success(`${data.name} category has been deleted`);
            }
          });
        }
      });
    },
  },
};
</script>