<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Fight</div>
                    <div class="card-body">
                        Fight has Been Started
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
        },
    }
</script>
