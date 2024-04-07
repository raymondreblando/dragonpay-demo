document.addEventListener('DOMContentLoaded', () => {
	const addToCartBtns = document.querySelectorAll('.add-to-cart');
	const paymentMethodRadios = document.querySelectorAll('.payment-method');

	const cartQuantityTxt = document.getElementById('cart-quantity');
	const confirmOrderBtn = document.getElementById('confirm-order-btn');

	addToCartBtns.forEach(addToCartBtn => {
		addEvent({
			element: addToCartBtn,
			callback: ({ currentTarget }) => {
				const productId = currentTarget.dataset.index;
				const formData = new FormData();
				formData.append('product_id', productId);
				
				request({
					url: './cart',
					option: { 
						method: 'POST', 
						body: formData 
					},
					callback: (response) => {
						cartQuantityTxt.textContent = response.data;
					}
				});
			},
		});
	});

	addEvent({
		element: confirmOrderBtn,
		callback: () => {
			disabled(confirmOrderBtn);

			request({
				url: './pay',
				option: { 
					method: 'POST', 
					body: null
				},
				callback: (response) => {
					const url = document.createElement('a');
					url.href = response.Url;
					url.click();
					url.remove();
				},
				button: confirmOrderBtn
			});
	}});

	paymentMethodRadios.forEach(paymentMethodRadio => {
		addEvent({
			element: paymentMethodRadio, 
			callback: () => {
				removeClassnames(paymentMethodRadios, 'active');
				paymentMethodRadio.classList.add('active');
			}
		})
	});

	function exist(element) {
		return Array.isArray(element) ? 
			element.length : 
			element !== null;
	}
	
	function addEvent({ 
		element, 
		callback, 
		type = 'click' 
	}) {
		if (!exist(element)) return
		element.addEventListener(type, callback);
	}
	
	function removeClassnames(elements, style) {
		elements.forEach(element => {
			element.classList.remove(style)
		});
	}
	
	function toastNotification(message, style) {
		const toast = document.querySelector('.toast');
		const toastMessage = document.querySelector('.toast-message');

		toast.classList.add(style);
		toastMessage.textContent = message;
	
		setTimeout(() => {
			toast.classList.remove(style);
		}, 1300);
	}
	
	async function request({
		url = null,
		option = {},
		callback = null,
		button = null
	}) {
		
		try {
			const response = await fetch(url, {...option});
			const data = await response.json();
			// const data = await response.text();
			// console.log(data)

			if (data.hasOwnProperty('errors')) {
				return toastNotification(data.errors[0],'error');
			}

			if (data.hasOwnProperty('message')) {
				toastNotification(data.message, 'success');
			}

			if (callback) {
				callback(data);
			}
		} catch (error) {
			console.log(error);
			toastNotification('An error occur. Try again','error');
		} finally {
			if (button !== null) {
				disabled(button, false);
			}
		}
	}

	function disabled(element, isDisabled = true) {
		if (isDisabled) {
			element.setAttribute('disabled', '');
		} else {
			element.removeAttribute('disabled');
		}
	}
});