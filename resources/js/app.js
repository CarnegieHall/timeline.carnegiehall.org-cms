window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Vue from "vue";

Vue.component(
  "song-finder",
  require("./components/AppleMusicSongIdentifierWidget/Index.vue").default
);

new Vue({
  el: "#song-finder-widget"
});
