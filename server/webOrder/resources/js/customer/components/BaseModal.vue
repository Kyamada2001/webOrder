<template>
  <div class="fixed w-full h-full top-0 left-0 flex items-center justify-center z-10" v-if="open">
    <div class="absolute w-full h-full bg-gray-900 bg-opacity-50" @click="close"></div>

    <div class="absolute max-h-full w-full px-3 md:w-2/3 md:px-0">
      <div class="container bg-white overflow-hidden md:rounded">
        <div class="px-4 py-4 leading-none flex justify-between items-center font-medium text-sm bg-gray-100 border-b select-none">
          <h3>{{ title }}</h3>
          <div @click="close" class="text-2xl hover:text-gray-600 cursor-pointer">
            &#215;
          </div>
        </div>

        <div class="max-h-full px-4 py-4">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        open: true,
      };
    },
    props: {
      title: {
        type: String,
        default: "",
      },
      header: {
        type: String,
        required: false,
        default: "",
      },
      width: {
        type: String,
        default: "full",
        validator: (value) => ["xs", "sm", "md", "lg", "full","1/2"].indexOf(value) !== -1,
      },
      mdwidth: {
        type: String,
        default: "full",
        validator: (value) => ["xs", "sm", "md", "lg", "full","1/2"].indexOf(value) !== -1,
      },
    },
    methods: {
      close() {
        this.open = false;
        this.$emit("close");
      },
    },
    computed: {
      maxWidth() {
        switch (this.width) {
          case "xs":
            return "md:max-w-lg";
          case "sm":
            return "md:max-w-xl";
          case "md":
            return "md:max-w-2xl";
          case "lg":
            return "md:max-w-3xl";
          case "full":
            return "md:max-w-full";
          case "1/2":
            return "md:w-1/2";
        }
      },
      mdWidth() {
        switch (this.mdwidth) {
          case "xs":
            return "md:w-lg";
          case "sm":
            return "md:w-xl";
          case "md":
            return "md:w-2xl";
          case "lg":
            return "md:w-3xl";
          case "full":
            return "md:w-full";
          case "1/2":
            return "md:w-1/2";
        }
      },
    },
    mounted() {
      const onEscape = (e) => {
        if (e.key === "Esc" || e.key === "Escape") {
          this.close();
        }
      };

      document.addEventListener("keydown", onEscape);

      this.$once("hook:beforeDestroy", () => {
        document.removeEventListener("keydown", onEscape);
      });
    },
  };
</script>