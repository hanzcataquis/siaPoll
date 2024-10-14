<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        background-color: rgba(0, 0, 0, 0.8); 
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">2N1 Cafe Corp</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="add_product.php">Add Product</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Survey Analytics</h2>

    <div class="row mt-5">
        <div class="col-md-6">
            <h4>Most Purchased Categories</h4>
            <canvas id="categoryChart"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Most Purchased Products per Category</h4>
            <canvas id="productChart"></canvas>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-6">
            <h4>Purchases by Gender</h4>
            <canvas id="genderChart"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Purchases by Age Group</h4>
            <canvas id="ageChart"></canvas>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <h4>Most Purchased Sizes</h4>
            <canvas id="sizeChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let analyticsData;

    fetch('fetch_analytics.php')
        .then(response => response.json())
        .then(data => {
            analyticsData = data;
            renderCharts(data);
        })
        .catch(error => console.error('Error loading analytics:', error));

    document.getElementById('categorySelect').addEventListener('change', function () {
        const selectedCategory = this.value;
        if (selectedCategory === 'general') {
            renderCharts(analyticsData);
        } else {
            const filteredProducts = analyticsData.products.filter(item => item.category === selectedCategory);
            const filteredData = { ...analyticsData, products: filteredProducts };
            renderCharts(filteredData);
        }
    });

    function renderCharts(data) {
        const categoryColors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 205, 86, 0.2)'];
        const productColors = ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(201, 203, 207, 0.2)', 'rgba(75, 192, 192, 0.2)'];
        const ageColors = ['rgba(153, 102, 255, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(54, 162, 235, 0.2)'];
        const sizeColors = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 205, 86, 0.2)'];

        new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: {
                labels: data.categories.map(item => item.category),
                datasets: [{
                    label: 'Total Purchases',
                    data: data.categories.map(item => item.total),
                    backgroundColor: categoryColors,
                    borderColor: categoryColors.map(color => color.replace('0.2', '1')),
                    borderWidth: 1
                }]
            }
        });

        new Chart(document.getElementById('productChart'), {
            type: 'bar',
            data: {
                labels: data.products.map(item => `${item.category} - ${item.product}`),
                datasets: [{
                    label: 'Total Purchases',
                    data: data.products.map(item => item.total),
                    backgroundColor: productColors,
                    borderColor: productColors.map(color => color.replace('0.2', '1')),
                    borderWidth: 1
                }]
            }
        });

        new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: data.gender.map(item => item.gender),
                datasets: [{
                    label: 'Purchases by Gender',
                    data: data.gender.map(item => item.total),
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            }
        });

        new Chart(document.getElementById('ageChart'), {
            type: 'bar',
            data: {
                labels: data.age.map(item => item.age_group),
                datasets: [{
                    label: 'Purchases by Age Group',
                    data: data.age.map(item => item.total),
                    backgroundColor: ageColors,
                    borderColor: ageColors.map(color => color.replace('0.2', '1')),
                    borderWidth: 1
                }]
            }
        });

        new Chart(document.getElementById('sizeChart'), {
            type: 'bar',
            data: {                
                labels: data.sizes.map(item => `${item.product} - ${item.size}`),
                datasets: [{
                    label: 'Total Purchases',
                    data: data.sizes.map(item => item.total),
                    backgroundColor: sizeColors,
                    borderColor: sizeColors.map(color => color.replace('0.2', '1')),
                    borderWidth: 1
                }]
            }
        });
    }
</script>

</body>
</html>
