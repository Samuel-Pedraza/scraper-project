<h2 class="text-center pt-5">Table Overview</h2>

<table class="table">
  <thead>
    <tr class="text-center"> 
      <th scope="col">Headlines</th>
    </tr>
  </thead>
  <tbody id="articleList" class="text-center">
  </tbody>
</table>
<script>
    fetch('http://localhost:9000?endpoint=articleList')
    .then(response => response.json())
    .then(data => {
        document.getElementById('articleList').innerHTML = data.map(article => {
            return `<tr>
                <td>${article.name}</td>
            </tr>`
        }).join('');
    });
</script>