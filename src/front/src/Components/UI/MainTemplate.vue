<template>
    <div v-session class="container">
        <div class="content">
            <div class="nav">
                <slot name="navbar"></slot>
            </div>
            <div class="contentBody" >
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { useCookies } from "vue3-cookies";

export default {
  name: "MainTemplate",
  setup(){
    const { cookies } = useCookies();
    return { cookies };

  },
  mounted() {
    this.checkCookie(Number(this.$route.params.userId));
  },
  methods: {
    checkCookie(userId) {
      if (this.cookies.isKey("auth")) {
          if (this.cookies.get("auth").userId !== userId) {
            this.$router.push({
              name: `AuthPage`,
            });
          }
      } else {
        this.$router.push({
          name: `AuthPage`,
        });
      }
    }
  }

}
</script>

<style scoped>
.content{
    width: 100%;
    height: 100%;
    display: flex;
}
.contentBody{
    width: 100%;
    display: flex;
    margin-top: 5%;
}
.container{
    padding: 0;
}
</style>
