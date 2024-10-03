
<div class="content-section" id="mainContent">
  <header>
        <div class="logo">Logo Công Ty</div>
        <h1>Thống Kê Doanh Thu</h1>
        <div class="time-selector">
            <label for="time-range">Thời gian:</label>
            <select id="time-range">
                <option value="today">Hôm nay</option>
                <option value="week">Tuần này</option>
                <option value="month">Tháng này</option>
                <option value="year">Năm này</option>
            </select>
        </div>
    </header>

    <main>
        <section class="summary">
            <h2>Tổng Doanh Thu: <span class="total-revenue">10,000,000 VNĐ</span></h2>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </section>

        <section class="summary">
            <h2>Phân Tích Theo Danh Mục</h2>
            <div class="chart-container">
                <canvas id="categoryChart"></canvas>
            </div>
        </section>

        <section class="filters">
            <h3>Lọc Dữ Liệu</h3>
            <label for="category">Danh mục:</label>
            <select id="category">
                <option value="all">Tất cả</option>
                <option value="product1">Sản phẩm 1</option>
                <option value="product2">Sản phẩm 2</option>
            </select>
            <button class="apply-filter">Áp Dụng Lọc</button>
        </section>

        <section class="transaction-table">
            <h3>Danh Sách Giao Dịch</h3>
            <table>
                <thead>
                    <tr>
                        <th>Ngày</th>
                        <th>Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Doanh Thu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01/10/2024</td>
                        <td>Sản phẩm A</td>
                        <td>5</td>
                        <td>1,000,000 VNĐ</td>
                    </tr>
                    <tr>
                        <td>02/10/2024</td>
                        <td>Sản phẩm B</td>
                        <td>10</td>
                        <td>2,000,000 VNĐ</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

   >
</div>

    <script>
        // Biểu đồ doanh thu
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'bar', // Biểu đồ cột
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7'],
                datasets: [{
                    label: 'Doanh Thu (VNĐ)',
                    data: [12000000, 15000000, 13000000, 17000000, 16000000, 18000000, 20000000],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Biểu Đồ Doanh Thu'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Doanh Thu (VNĐ)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tháng'
                        }
                    }
                }
            }
        });

        // Biểu đồ tròn
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(ctxCategory, {
            type: 'pie', // Biểu đồ tròn
            data: {
                labels: ['Sản phẩm A', 'Sản phẩm B', 'Sản phẩm C'],
                datasets: [{
                    label: 'Tỷ Lệ Doanh Thu',
                    data: [30, 50, 20], // Tỷ lệ doanh thu của từng sản phẩm
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Phân Tích Doanh Thu Theo Danh Mục'
                    }
                }
            }
        });
    </script>
