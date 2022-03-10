<template>
    <ul :key="componentKey">
        <li v-bind:class="[getClassNameForReplies]" v-for="comment in comments">
            <div class="comment-block">
                <div class="author-thumb">
                    <img src="https://via.placeholder.com/150.png/O" loading="lazy" :alt="comment.title">
                </div>
                <div class="right-content">
                    <h4>{{ comment.user_name }} <span>{{ comment.created_at }}</span></h4>
                    <!-- Link the user email if exists -->
                    <small v-if="comment.user_email !== null">
                        <a class="text-decoration-none" style="font-size: 10px;"
                           :href="'mailto:' + comment.user_email">{{ comment.user_email }}</a>
                    </small>
                    <p>{{ comment.content }}</p>
                </div>
                <hr>
                <div class="row submit-comment">
                    <div class="col-12 mb-1">
                        <button class="btn btn-primary" type="button" data-toggle="collapse"
                                :data-target="'#collapse' + comment.id" aria-expanded="false"
                                :aria-controls="'collapse' + comment.id">
                            Reply This Comment
                        </button>
                    </div>
                    <div class="col-12 collapse" :id="'collapse' + comment.id">
                        <h5>Reply This Comment</h5><br>
                        <add-comment-component :post-id="postId" :parent-id="comment.id"></add-comment-component>
                    </div>

                </div>
            </div>
            <comments-component v-if="comment.replies !== undefined" :post-id="postId"
                                :parent-id="comment.id"></comments-component>
        </li>
    </ul>

</template>

<script>
export default {
    props: {
        parentId: {type: Number, required: false},
        postId: {type: Number, required: false},
        level: {type: Number, required: false}
    },
    name: "CommentsComponent",

    data() {
        return {
            comments: [],
            singleComment: {},
            componentKey: 0,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('value'),
        }
    },

    mounted() {
        /**
         * New comment created event
         */
        this.$root.$on('onCommentCreated', () => {
            this.forceRerender();
        });

        this.getComments();
    },
    computed: {
        /**
         * Provides the reply's class name property regards to its level.
         *
         * @returns {string|string}
         */
        getClassNameForReplies: function () {
            return this.parentId ? 'replied' + (this.level && this.level !== 1 ? this.level : '') : '';
        },
    },
    methods: {
        /**
         * Re-renders the component
         */
        forceRerender() {
            this.getComments();
            this.componentKey += 1;
        },
        /**
         * Requests the comments with an API call
         */
        getComments() {
            let url = '/api/comments/' + this.postId + (this.parentId ? '/' + this.parentId : '');
            window.axios.get(url).then(res => {
                console.log(res.data);
                this.comments = res.data
            });
        }
    }
}
</script>
