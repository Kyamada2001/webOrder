<template>
<div>
    <Multiselect
        v-model="holidays"
        mode="tags"
        placeholder="選択してください"
        :options="options"
        :createTag="true"
        :close-on-select="false"
    />
    <input type="hidden" :value="holidays" name="weekly_holidays">
</div>
</template>
<script>
  //import Multiselect from '@vueform/multiselect'
  import Multiselect from '@vueform/multiselect/dist/multiselect.vue2.js'

  export default {
    components: {
      Multiselect,
    },
    data() {
      return {
        holidays: [],
        options: [
          { value: 1, label: '月' },
          { value: 2, label: '火' },
          { value: 3, label: '水' },
          { value: 4, label: '木' },
          { value: 5, label: '金' },
          { value: 6, label: '土' },
          { value: 7, label: '日' },
          { value: 8, label: '不定期' },
          { value: 0, label: '無休' },
        ]
      }
    }
  }
</script>

<style src="@vueform/multiselect/themes/default.css"></style>