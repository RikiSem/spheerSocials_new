<template>
    <span style="color: #39b443"> {{ msg }} </span>
</template>

<script>
export default {
    name: "SuccessMsg",
    props: {
      msg: {
            type: String
        }
    }
}
</script>

<style scoped>

</style>
