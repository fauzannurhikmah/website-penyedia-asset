<template>
  <div>
    <form method="POST" action="#" @submit.prevent="login">
      <div class="form-group">
        <label for="email">Email <Address></Address></label>
        <input
          id="email"
          type="email"
          class="form-control"
          v-model="form.email"
          autocomplete="email"
          autofocus
        />
        <span
          class="text-danger text-small"
          role="alert"
          v-if="theErrors.email"
        >
          <strong>{{ theErrors.email[0] }}</strong>
        </span>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
          id="password"
          type="password"
          class="form-control"
          v-model="form.password"
          autocomplete="current-password"
        />
        <span
          class="text-danger text-small"
          role="alert"
          v-if="theErrors.password"
        >
          <strong>{{ theErrors.password[0] }}</strong>
        </span>
      </div>
      <div class="form-group">
        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            v-model="form.remember"
            id="remember"
          />
          <label class="form-check-label" for="remember"> Remember me </label>
        </div>
      </div>
      <div class="form-group mb-0">
        <button type="submit" class="btn btn-custom">
          <div class="d-flex justify-content-center">
            <span>Login </span>
            <epic-spinner class="ml-2" v-if="loading"></epic-spinner>
          </div>
        </button>
        <a class="btn btn-link" href=""> Forgot Your Password ? </a>
      </div>
    </form>
  </div>
</template>

<script>
import EpicSpinner from "../loading/Loading.vue";
export default {
  components: { EpicSpinner },
  data() {
    return {
      form: {
        email: "",
        password: "",
        remember: false,
      },
      theErrors: [],
      loading: false,
    };
  },

  methods: {
    async login() {
      this.loading = true;
      try {
        let response = await axios.post("/api/login", this.form);
        if (response.status == 200) {
          this.loading = false;
          localStorage.setItem("user", JSON.stringify(response.data.user));
          localStorage.setItem("jwt", response.data.token);
          console.log(response.data.token);
        }
      } catch (e) {
        this.loading = false;
        this.theErrors = e.response.data.errors;
      }
    },
  },
};
</script>
