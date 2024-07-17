<template>
    <div class="listItem">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "ListItem"
}
</script>

<style scoped>
.listItem{
    border: 1px solid var(--color);
    border-radius: 10px;
    padding: 10px;
    margin-top: 10px;
}
</style>
