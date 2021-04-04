<template>
    <div>
        <h2 class="text-center">knights List</h2>
        <div id="loader-view" v-show="loading">
            <section class="loader-container">
                <span class="loader"></span>
            </section>
        </div>
        <template v-if="!loading">
            <button class="btn btn-success" v-if="knights.length>0&&knights.length==2" @click="startFight()">Start Competition</button>
            <table class="table" v-if="knights.length>0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Courage</th>
                    <th>Justice</th>
                    <th>Faith</th>
                    <th>Mercy</th>
                    <th>Generosity</th>
                    <th>Hope</th>
                    <th v-show="knights.length>2">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="knight in knights" :key="knight.id">
                    <td>{{ knight.id }}</td>
                    <td>{{ knight.name }}</td>
                    <td>{{ knight.age }}</td>
                    <td>{{ appendPercentage(knight.courage) }}</td>
                    <td>{{ appendPercentage(knight.justice) }}</td>
                    <td>{{ appendPercentage(knight.faith) }}</td>
                    <td>{{ appendPercentage(knight.mercy) }}</td>
                    <td>{{ appendPercentage(knight.generosity) }}</td>
                    <td>{{ appendPercentage(knight.hope) }}</td>
                    <td>
                        <div class="btn-group" role="group" v-show="knights.length>2">
                            <button class="btn btn-success" @click="deleteKnight(knight.id)">Remove Knight</button>
                        </div>
                    </td>
                    <td v-if="knight.is_winner">
                        <button class="btn btn-success">Winner</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="text-center text-bold" v-else>
                <p>There are no Knights Record. Please contact support.</p>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                knights: [],
                loading: false
            }
        },
        created() {
            this.loading = true;
            this.axios
                .get('http://localhost:8000/api/knights/')
                .then(response => {
                    console.log(response);
                    this.knights = response.data.data;
                    this.loading = false;
                });
        },
        methods: {
            deleteKnight(id) {
                let i = this.knights.map(data => data.id).indexOf(id);
                this.knights.splice(i, 1)
                this.axios
                    .post(`http://localhost:8000/api/knights`, this.pluck(this.knights,'id'))
                    .then(response => {
                        console.log(response);
                    });
            },
            appendPercentage(_val) {
                return _val+'%';
            },
            pluck(array, key) {
                return array.map(o => o[key]);
            },
            startFight() {
                this.axios
                .get('http://localhost:8000/api/start-fight')
                .then(response => {
                    console.log(response);
                    this.knights = response.data.data;
                    this.loading = false;
                });
            }
        }
    }
</script>
<style scoped>
.loader-container {
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 30vh;
    display: flex;
}
.loader {
  border: 10px solid #f3f3f3;
  border-radius: 50%;
  border-top: 10px solid #3498db;
  width: 100px;
  height: 100px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
