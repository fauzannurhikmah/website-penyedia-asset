<template>
  <div class="card card-body">
    <div class="row">
      <div class="col-3">
        <div class="list-group" id="list-tab" role="tablist">
          <a
            class="list-group-item list-group-item-action active show"
            id="list-home-list"
            data-toggle="list"
            href="#list-details"
            role="tab"
            aria-selected="true"
          >
            Details<span
              v-if="theErrors.name || theErrors.description"
              class="beep"
            ></span>
          </a>
          <a
            class="list-group-item list-group-item-action"
            id="list-profile-list"
            data-toggle="list"
            href="#list-files"
            role="tab"
            aria-selected="false"
          >
            Files<span
              v-if="theErrors.file || theErrors.preview"
              class="beep"
            ></span
          ></a>
          <a
            class="list-group-item list-group-item-action"
            id="list-messages-list"
            data-toggle="list"
            href="#list-sorting"
            role="tab"
            aria-selected="false"
            >Sorting<span
              v-if="theErrors.category || theErrors.tags"
              class="beep"
            ></span
          ></a>
          <a
            class="list-group-item list-group-item-action"
            id="list-settings-list"
            data-toggle="list"
            href="#list-preview"
            role="tab"
            aria-selected="false"
            >Preview</a
          >
          <a
            class="list-group-item list-group-item-action"
            id="list-settings-list"
            data-toggle="list"
            href="#list-software"
            role="tab"
            aria-selected="false"
            >Software<span
              v-if="theErrors.render || theErrors.software"
              class="beep"
            ></span
          ></a>
          <a
            class="list-group-item list-group-item-action"
            id="list-settings-list"
            data-toggle="list"
            href="#list-licensing"
            role="tab"
            aria-selected="false"
            >Licensing<span v-if="theErrors.licensing" class="beep"></span
          ></a>
          <a
            class="list-group-item list-group-item-action"
            id="list-settings-list"
            data-toggle="list"
            href="#list-final"
            role="tab"
            aria-selected="false"
            >Final</a
          >
        </div>
      </div>
      <div class="col-9">
        <form @submit.prevent="create">
          <div class="tab-content" id="nav-tabContent">
            <div
              class="tab-pane fade active show"
              id="list-details"
              role="tabpanel"
              aria-labelledby="list-details-list"
            >
              <div class="form">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input
                    type="text"
                    v-model="form.name"
                    id="name"
                    class="form-control"
                  />
                  <small v-if="theErrors.name" class="text-danger">{{
                    theErrors.name[0]
                  }}</small>
                </div>
                <div class="form-group">
                  <label for="name">Description</label>
                  <ckeditor
                    :editor="CKEditor.editor"
                    v-model="form.description"
                    tag-name="textarea"
                    :config="CKEditor.editorConfig"
                  ></ckeditor>
                  <small v-if="theErrors.description" class="text-danger">{{
                    theErrors.description[0]
                  }}</small>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="list-files"
              role="tabpanel"
              aria-labelledby="list-files-list"
            >
              <div class="form">
                <div class="form-group">
                  <label for="asset" class="form-label">Asset File</label>
                  <input
                    type="file"
                    class="form-control"
                    id="asset"
                    ref="file"
                    @change="fileAsset"
                  />
                  <small v-if="theErrors.file" class="text-danger">{{
                    theErrors.file[0]
                  }}</small>
                  <small v-else class="text-primary"
                    >The file asset must be zip, c4d, obj, 3ds. max.</small
                  >
                </div>
                <div class="form-group">
                  <label for="image" class="form-label"
                    >Featured Preview Image</label
                  >
                  <input
                    type="file"
                    class="form-control"
                    ref="preview"
                    id="image"
                    @change="fileImage"
                  />
                  <small v-if="theErrors.preview" class="text-danger">{{
                    theErrors.preview[0]
                  }}</small>
                  <div class="mt-3 text-center" v-if="livePreview">
                    <p class="mb-0 text-primary font-weight-light">
                      Image Preview
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
            <div
              class="tab-pane fade"
              id="list-sorting"
              role="tabpanel"
              aria-labelledby="list-sorting-list"
            >
              <div class="form-group">
                <label for="category">Category</label>
                <select
                  v-model="form.category"
                  id="category"
                  class="form-control"
                >
                  <option value="" disabled>Choose Category</option>
                  <option
                    :value="category.id"
                    v-for="category in categoryList"
                    :key="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <small v-if="theErrors.category" class="text-danger">{{
                  theErrors.category[0]
                }}</small>
              </div>
              <div class="form-group">
                <label for="tags">Tags</label>
                <vue-tags-input
                  v-model="form.tags"
                  :tags="systemTags"
                  ref="tags"
                  @tags-changed="(newTags) => (systemTags = newTags)"
                />
                <small v-if="theErrors.tags" class="text-danger">{{
                  theErrors.tags[0]
                }}</small>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="list-preview"
              role="tabpanel"
              aria-labelledby="list-preview-list"
            >
              <div class="form">
                <div class="form-group">
                  <label for="youtube" class="form-label"
                    >Youtube Link Video</label
                  >
                  <input
                    type="text"
                    v-model="form.youtube"
                    class="form-control"
                    id="youtube"
                  />
                  <small class="text-info">Can be empty</small>
                </div>
                <div class="form-group">
                  <label for="sketchfab" class="form-label"
                    >Sketchfab Model Link</label
                  >
                  <input
                    type="text"
                    v-model="form.sketchfab"
                    class="form-control"
                    id="sketchfab"
                  />
                  <small class="text-info">Can be empty</small>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="list-software"
              role="tabpanel"
              aria-labelledby="list-software-list"
            >
              <div class="form">
                <div class="form-group">
                  <label for="software" class="form-label">Software</label>
                  <select
                    v-model.number="form.software"
                    id="software"
                    class="form-control"
                  >
                    <option value="" disabled>Choose Software</option>
                    <option
                      :value="software.id"
                      v-for="software in softwareList"
                      :key="software.id"
                    >
                      {{ software.name }}
                    </option>
                  </select>
                  <small v-if="theErrors.software" class="text-danger">{{
                    theErrors.software[0]
                  }}</small>
                </div>
                <div class="form-group">
                  <label for="render" class="form-label">Render Engine</label>
                  <select
                    v-model.number="form.render"
                    id="render"
                    class="form-control"
                  >
                    <option value="" disabled>Choose Render</option>
                    <option
                      :value="render.id"
                      v-for="render in renderList"
                      :key="render.id"
                    >
                      {{ render.name }}
                    </option>
                  </select>
                  <small v-if="theErrors.render" class="text-danger">{{
                    theErrors.render[0]
                  }}</small>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="list-licensing"
              role="tabpanel"
              aria-labelledby="list-licensing-list"
            >
              <div class="form">
                <div class="form-group">
                  <label for="licensing" class="form-label">Licensing</label>
                  <select
                    v-model.number="form.licensing"
                    id="licensing"
                    class="form-control"
                  >
                    <option value="" disabled>Choose Licensing</option>
                    <option value="0">Free</option>
                    <option value="1">Premium</option>
                  </select>
                  <small v-if="theErrors.licensing" class="text-danger">{{
                    theErrors.licensing[0]
                  }}</small>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="list-final"
              role="tabpanel"
              aria-labelledby="list-final-list"
            >
              <p>
                By checking the box below, you acknowledge that this blend was
                created by you, or by someone else who has given you explicit
                permission to publish it.
              </p>
              <div class="form">
                <div class="custom-control custom-checkbox">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    id="customCheck1"
                  />
                  <label class="custom-control-label" for="customCheck1"
                    >I Accept the <a href="">Terms and Conditions</a></label
                  >
                </div>
                <div class="form-group d-flex justify-content-end">
                  <button type="submit" class="btn btn-custom d-flex">
                    <span>Upload</span>
                    <epic-spinner
                      v-if="loading"
                      type="1"
                      class="ml-2"
                    ></epic-spinner>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


<script>
import VueTagsInput from "@johmun/vue-tags-input";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import EpicSpinner from "../loading/Loading.vue";
import "../../vendor.js";
export default {
  components: { EpicSpinner, VueTagsInput, ClassicEditor },
  data() {
    return {
      CKEditor: {
        editor: ClassicEditor,
        editorConfig: {
          height: "300px",
          toolbar: {
            items: [
              "heading",
              "bold",
              "italic",
              "link",
              "undo",
              "redo",
              "bulletedList",
              "numberedList",
              "blockQuote",
            ],
          },
        },
      },
      loading: false,
      form: {
        name: "",
        description: "",
        category: "",
        tags: "",
        software: "",
        render: "",
        youtube: "",
        sketchfab: "",
        licensing: "",
        secretId: "",
      },
      systemTags: [],
      file: null,
      preview: null,
      livePreview: null,
      categoryList: [],
      softwareList: [],
      renderList: [],
      theErrors: [],
      finalTags: [],
    };
  },

  beforeMount() {
    this.getDataCategory();
    this.getDataSoftware();
    this.getDataRender();
  },

  methods: {
    async getDataCategory() {
      let response = await axios.get("/api/category/get");
      if (response.status == 200) this.categoryList = response.data;
    },
    async getDataSoftware() {
      let response = await axios.get("/api/software/get");
      if (response.status == 200) this.softwareList = response.data;
    },
    async getDataRender() {
      let response = await axios.get("/api/render/get");
      if (response.status == 200) this.renderList = response.data;
    },
    fileImage(event) {
      var input = event.target;
      if (input.files) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.livePreview = e.target.result;
        };
        this.preview = input.files[0];
        reader.readAsDataURL(input.files[0]);
      }
    },

    fileAsset(event) {
      this.file = event.target.files[0];
    },

    async create() {
      try {
        this.convertToArray();
        const data = this.collectFormData();
        const config = { headers: { "Content-Type": "multipart/form-data" } };
        this.loading = true;
        let response = await axios.post("/api/asset/upload", data, config);
        if (response.status == 200) {
          this.file = this.preview = this.livePreview = null;
          this.form.name =
            this.form.description =
            this.form.category =
            this.form.tags =
            this.form.software =
            this.form.render =
            this.form.youtube =
            this.form.sketchfab =
            this.form.licensing =
              "";
          this.$refs.file.value = this.$refs.preview.value = null;
          this.$refs.tags.value = null;
          this.loading = false;
          this.$toast.success("Uploaded file has been succesfuly");
          this.theErrors = [];
        }
      } catch (e) {
        this.loading = false;
        this.theErrors = e.response.data.errors;
        this.$toast.error("Something went wrong");
      }
    },

    convertToArray() {
      this.systemTags.forEach((val, index) => {
        this.finalTags[index] = Object.values(val);
      });
    },

    collectFormData() {
      let formData = new FormData();
      this.form.secretId = document
        .querySelector("meta[name='user-id']")
        .getAttribute("content");
      formData.append("preview", this.preview);
      formData.append("file", this.file);
      formData.append("name", this.form.name);
      formData.append("description", this.form.description);
      formData.append("tags", this.finalTags);
      formData.append("software", this.form.software);
      formData.append("render", this.form.render);
      formData.append("category", this.form.category);
      formData.append("licensing", this.form.licensing);
      formData.append("youtube", this.form.youtube);
      formData.append("sketchfab", this.form.sketchfab);
      formData.append("user_id", this.form.secretId);
      return formData;
    },
  },
};
</script>

<style>
.beep:after {
  right: -10px !important;
}

.vue-tags-input[data-v-61d92e31] {
  max-width: 100% !important;
}

.ti-input[data-v-61d92e31] {
  border: 1px solid #e4e6fc;
  border-radius: 0.2rem;
  padding: 8px;
}

.ck-editor__editable {
  height: 200px !important;
  overflow-y: auto;
}
</style>
