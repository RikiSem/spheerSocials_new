<template>
    <div class="content">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "ContentTemplate"
}
</script>

<style scoped>
.content{
    word-wrap: break-word;
    width: border-box;
}
</style>
