<template>
    <vue-timepicker-former
        format="HH:mm"
        minute-interval="15"
        :name="data.name"
        hour-label="時"
        placeholder="時:分"
        minute-label="分"
        v-model="data.time">
    </vue-timepicker-former>
</template>

<script>
export default {
    props: {
        data: {},
    },
}
</script>