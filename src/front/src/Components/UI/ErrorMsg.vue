<template>
    <span style="color: #ad2828"> {{ msg }} </span>
</template>

<script>
export default {
    name: "ErrorMsg",
    props: {
      msg: {
            type: String
        }
    }
}
</script>

<style scoped>

</style>
