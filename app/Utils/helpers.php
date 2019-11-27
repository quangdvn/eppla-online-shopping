<?php
    //* Built-in helper functions through-out the Project

function presentPrice($price)
{
    return '$' . number_format($price / 100, 2);
}

    function setActive($queryString, $contentSlug, $output = 'active')
    {
        return $queryString == $contentSlug ? $output : '';
    }

    function calculateTotal()
    {
        //* Set up some values after using coupon
        // Current tax is 10%
        $taxConst = config('cart.tax') / 100;

        // Get discount value if coupon is applied
        $discount = session()->get('coupon')['discount'] ?? 0;

        $code = session()->get('coupon')['name'] ?? null;

        // Get new subtotal after coupon is applied
        $newSubtotal = (Cart::instance('shopping')->subtotal() - $discount);
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }

        // Get new tax value after coupon is applied
        $newTax = $newSubtotal * $taxConst;

        // Get new total after coupon is applied
        $newTotal = $newSubtotal * (1 + $taxConst);

        return collect([
            'taxConst' => $taxConst,
            'discount' => $discount,
            'code' => $code,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }

    function productImage($path)
    {
        return $path && file_exists("storage/{$path}")
                ? asset("storage/{$path}")
                : asset('img/not-found.jpg');
    }

    function redirectNotUser($user)
    {
        if ($user->role_id != 2) {
            return true;
        }
    }
