<template>
    <div class="post">
        <div class="feedItemHeader">
            <img class="avatar" :src="this.coreUrl + item.author.avatar">
            <p>{{ item.author.login }}</p>
            <p>{{ item.created_at }}</p>
        </div>
        <div class="feedItemBody">
            <p>{{ item.text }}</p>
            <div class="feedItemFiles">
                <my-file v-for="file in item.files" :file="file"></my-file>
            </div>
            <post-control-panel></post-control-panel>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            type: Object
        }
    },
    name: "MyPost"
}
</script>

<style scoped>
.avatar{
  width: clamp(5rem, 0.25rem + 2vw, 2rem);
  border-radius: 50%;
}
.post{
    padding: 5px;
    min-width: 70%;
    margin: 5px auto;
    border-radius: 7px;
    border: 1px solid var(--color);
}
.feedItemFiles{
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-content: flex-start;
}
</style>
