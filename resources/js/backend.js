window._ = require("lodash");

try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");

    require("bootstrap");
} catch (e) {}
import "select2";

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

require("./components/Delete");
require("./components/lyrics/Create");
require("./components/lyrics/Table");
require("./components/lyrics/Edit");
