window.Vue = require('vue').default;

Vue.component('category-form',require('./category/Category.vue').default)
Vue.component('software-form',require('./software/Software.vue').default)
Vue.component('render-form',require('./render/Render.vue').default)
Vue.component('user-form',require('./user/User.vue').default)
Vue.component('upload-form',require('./upload/Upload.vue').default)
Vue.component('list-upload',require('./upload/List.vue').default)
Vue.component('asset-form',require('./asset/Asset.vue').default)
Vue.component('download',require('./asset/Download.vue').default)