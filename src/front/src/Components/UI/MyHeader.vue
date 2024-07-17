<template>
    <div class="header">
        <div class="header_content">
            <img src="/public/mainPic.png">
            <p class="h4">Spheer</p>
        </div>

    </div>
</template>

<script>

export default {
    name: "MyHeader",
}
</script>

<style scoped>
.header{
    height: 30%;
    display: flex;
}

img{
    width: clamp(5rem, 0.25rem + 2vw, 2rem);
    border-radius: 50%;
    margin: auto;
}
.header_content {
    flex-direction: column;
    display: flex;
    margin: auto;
    padding: 10px;
}
p{
    margin: auto;
    font-family: "Bahnschrift";
    font-size: clamp(1rem, 0.25rem + 2vw, 2rem);
}
</style>
