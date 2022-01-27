<template>
  <section class="section">
    <div class="section-header">
      <h1>User</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">User</div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4>List User</h4>
        <div class="card-header-form">
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
      </div>
      <div class="card-body p-0">
        <table class="table" id="dataTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Email</th>
              <th scope="col">Username</th>
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
                  width="300"
                  type="list-item-two-line"
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
            <tr v-else v-for="(user, index) in userList.data" :key="user.id">
              <th scope="row">{{ ++index }}</th>
              <td>
                <p class="font-weight-bold mb-0">{{ user.email }}</p>
                <small class="text-primary">{{ user.created_at }}</small>
              </td>
              <td>{{ user.username }}</td>
              <td class="text-center">
                <a
                  :href="`/admin/user/${user.id}/detail`"
                  class="btn btn-outline-info border-0 mr-2 shadow-sm"
                  ><i class="fas fa-eye"></i
                ></a>
                <button
                  class="btn btn-outline-secondary border-0 mr-2 shadow-sm"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button
                  class="btn btn-outline-danger border-0 shadow-sm"
                  @click="deleteData(user)"
                >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>

            <!-- empty list -->
            <tr v-if="!loading.skeleton1 && !userList.data.length">
              <td colspan="4" class="text-center text-info font-weight-bold">
                Empty !
              </td>
            </tr>
          </tbody>
        </table>
        <pagination
          align="center"
          :data="userList"
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
      loading: { epic: false, skeleton1: false, skeleton2: false },
      userList: {},
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
      let response = await axios.get(`/api/user?page=${page}`, {
        params: { keywords: this.keywords },
      });
      if (response.status == 200) {
        this.loading.skeleton1 = false;
        this.userList = response.data;
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
          axios.delete(`/api/user/${data.username}/delete`).then((response) => {
            if (response.status == 200) {
              this.getData();
              this.$toast.success(`Account ${data.username} has been deleted`);
            }
          });
        }
      });
    },
  },
};
</script>