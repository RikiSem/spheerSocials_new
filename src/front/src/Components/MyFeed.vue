<template>
    <div class="feedNavigations">
        <my-button class="btn" @click="openPublic">Общая лента</my-button>
        <my-button class="btn" @click="openPrivate">Ваша лента</my-button>
    </div>
    <feed-content :show="publicFeed" :items="publicFeedData"></feed-content>
    <feed-content :show="privateFeed" :items="privateFeedData">
        <new-post-form @test="getPrivatePosts" :show="privateFeed"></new-post-form>
    </feed-content>
</template>

<script>
import FeedContent from "./FeedContent.vue";
import axios from "axios";
import NewPostForm from "./NewPostForm.vue";
export default {
    name: "MyFeed",
    components: {NewPostForm, FeedContent},
    data() {
        return {
            publicFeed: true,
            privateFeed: false,
            privateFeedData: [],
            publicFeedData: [],
        }
    },
    mounted() {
        this.getFeedData();
        this.getPrivatePosts();
        this.getPublicPosts();
    },
    methods: {
        async getPrivatePosts() {
            const response = await axios.get(`/api/post/private/get/${ this.$route.params.id }/${ this.$route.params.userId }`);
            this.privateFeedData = response.data.content;
        },
        async getPublicPosts() {
            const response = await axios.get(`/api/post/public/get/${ this.$route.params.id }/${ this.$route.params.userId }`);
        },
        async getFeedData(){
            const response = await axios.get(`/api/post/get/${ this.$route.params.id }/${ this.$route.params.userId }`);
            this.privateFeedData = response.data.content['privateFeed'];
            this.publicFeedData = response.data.content['publicFeed'];
        },
        openPublic(){
            this.privateFeed = false;
            this.publicFeed = true;
        },
        openPrivate(){
            this.privateFeed = true;
            this.publicFeed = false;
        },
    }
}
</script>

<style scoped>
.feedNavigations{
    display: flex;
    width: 100%;
    height: fit-content;
    border-bottom: 3px solid #4949a7;
}
.feedNavigations .btn{
    margin: auto;
    width: 100%;
    border: none;
    border-radius: 0px;
}
</style>
