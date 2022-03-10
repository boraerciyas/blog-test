<template>
    <div class="content" :key="componentKey">
        <form id="comment" action="#" method="post" @submit.prevent="createComment()">
            <input type="hidden" name="_token" :value="csrf">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <fieldset>
                        <input name="name" type="text" placeholder="Your name" required=""
                               v-model="singleComment.user_name">
                    </fieldset>
                </div>
                <div class="col-md-6 col-sm-12">
                    <fieldset>
                        <input name="email" type="text" placeholder="Your email" v-model="singleComment.user_email">
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset>
                        <textarea name="message" rows="6" placeholder="Type your comment" required=""
                                  v-model="singleComment.content"></textarea>
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset>
                        <button type="submit" class="main-button">Submit</button>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        postId: {type: Number, required: true},
        parentId: {type: Number, required: false}
    },
    name: "AddCommentComponent",

    data() {
        return {
            singleComment: {},
            componentKey: 0,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('value'),
        }
    },

    mounted() {
        console.log('Add New Comment Component mounted.');
    },

    methods: {
        /**
         * Creates a new comment with the submitted form data
         */
        createComment: function () {
            if (this.parentId) {
                this.singleComment.parent_comment_id = this.parentId;
            }
            this.singleComment.post_id = this.postId;
            window.axios
                .post(`/api/comments`, this.singleComment)
                .then((res) => {
                    console.log(res);
                    this.singleComment = {};
                    if (!res.data.success) {
                        this.$alert(res.data.msg, "Error", "error");
                    } else {
                        this.$root.$emit('onCommentCreated');
                    }
                })
                .catch(error => {
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        if (error.response.data.errors) {
                            this.$alert(error.response.data.message, "Error", "error");
                        }

                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                        this.$alert(error.request, "Error", "error");
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                        this.$alert(error.message, "Error", "error");
                    }
                });
        },
    }
}
</script>

<style scoped>

</style>
