<template>
    <span style="color: #ad2828"> {{ errorMsg }} </span>
</template>

<script>
export default {
    name: "ErrorMsg",
    props: {
        errorMsg: {
            type: String
        }
    }
}
</script>

<style scoped>

</style>
