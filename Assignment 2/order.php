<div class="container">
<?php if($success): ?>
    <div class="alert-success">
        <P class="success">Your pizza order has been placed successfully!</P>
        <a href="index.php">Place another order</a>
    </div>
    <?php endif; ?>
    <?php if(!empty($error)): ?>
    <div class="alert">
        <?php htmlspecialchars($error); ?>
    </div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="customer_name">Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="pizza_size">Pizza Size:</label>
            <select id="pizza_size" name="pizza_size" required>
                <option value="">-- Select Size --</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Toppings:</label>
            <label><input type="checkbox" name="toppings[]" value="Cheese">Cheese</label>
            <label><input type="checkbox" name="toppings[]" value="Pepperoni">Pepperoni</label>
            <label><input type="checkbox" name="toppings[]" value="Mushrooms">Mushrooms</label>
            <label><input type="checkbox" name="toppings[]" value="Sausage">Sausage</label>
        </div>

        <div class="form-group">
            <label for="instructions">Special Instructions:</label>
            <textarea id="instructions" name="instructions"></textarea>
        </div>