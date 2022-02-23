<template>
  <v-select
    v-model="selected"
    :items="weekly_holidays"
    item-text="label"
    item-value="value"
    attach
    chips
    multiple
    clearable
    placeholder="選択してください"
    outlined
    dense
  ></v-select>
</template>

<script>
  export default {
    props: {
      holiday: Array,
    },
    data: () => ({
      selectedHoliday: holiday,
      weekly_holidays: [
          { value: 1, label: "月" },
          { value: 2, label: '火' },
          { value: 3, label: '水' },
          { value: 4, label: '木' },
          { value: 5, label: '金' },
          { value: 6, label: '土' },
          { value: 7, label: '日' },
          { value: 8, label: '不定期' },
          { value: 0, label: '無休' },
      ]
    }),
  }
</script>