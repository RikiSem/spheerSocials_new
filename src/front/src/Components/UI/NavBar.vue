<template>
    <div class="navbar">
        <div class="navbarHeader">
            <slot name="header"></slot>
        </div>
        <div class="navbarContent">
            <slot name="content"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "NavBar"
}
</script>

<style scoped>
.navbar{
    padding: 0;
    margin: 0;
    height: available;
    max-width: max-content;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: normal;
}
.navbarHeader{
    width: 100%;
}
.navbarContent{
    display: flex;
    flex-direction: column;
    width: 100%;
    height: available;
}
</style>
