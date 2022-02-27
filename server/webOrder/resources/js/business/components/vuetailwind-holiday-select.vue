<template>
  <t-rich-select
    multiple
    :close-on-select="false"
    :options="['Option A', 'Option B', 'Option C', 'Option D']"
    placeholder="Select multiple options"
    :value="['Option B', 'Option C']"
  ></t-rich-select>
</template>