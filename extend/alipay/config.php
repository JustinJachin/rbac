<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016092100559401",

		//商户私钥
		'merchant_private_key' => 
		"MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCFj6sXDQaGwzjJHxuB+iQvx1MwBbhUXnOV7j1vMq7vXVs1p+Xf9Be+y+bvGhNj2UAtJvHT5PXOvhP5m4uG5KYZ85eaUkbTaKn844eodAIuopYZse2vkgB1GGYovXzVWIulQsWoGJdDF8IjWAcICIU5OusFymP/4HFily50Bn+9m1sFfMC4KMdpvNxslgPt4yByv0w8IdEO5O4Wfol4iVXhDgGJATi0surCFy0DUX8sdyC0a5YYFiDzq5mi0ZYFDXOPK2HnjLrnRsp3OZNevhD5JowNdo3R6Me0+KdjA8lhwDs9Rb8tJ495XT1rVqdpp8TW7rWOGcye5zm4T3h3tpIPAgMBAAECggEAAthQmKkaXnyCFSaoe1hMtQfV6cv1ZTat15+/h0LZHxgp/TaaWu7kIphNTwKLLzFNgKi3tf/GjKTX4BVEH5d3Qk5CCHOANrigBlcCaMAv27Zy5BE6Muc1Q0lFw9BlfFXqg5ashywe7Lrw07foTm+ABvwOTY1GHAk34RW/U5Ff3zYMFXO+Rh2XzzBcU7xPiNK78R4FHl9NSS3BwVUXbVczZ1vs42IMIuW4Caopwp+NL6kolwbLVIPw0yQTc5QaH5eIkg3FlUevTDRKnOg2MkTnc7f4ufhyWwgGDbquGW7+ca0AyptBlOAKmgMx9ZjOPU4hntfUgQpNYy8s6dRSn+ZAwQKBgQC7YtGMgPFaQx53tRUZf7XlOp+kk73GFnBUoAobLwS4dVHzDXyRnO4QGmpEtsbBGP2cyWsXIuHGd4cFNHk3O03mLElEwixEMD4ZeihpbtM5Iqjjjf8BZ5ExLAlQskYz4SzTUYEy+YKJXBJaGxIZMubdjVH50u6PjEd3V1RBaQxCaQKBgQC2d2wrzljQxEuYC73un6PsBp4lBLzcq5xnwATLu3dGZUGDPV0hawzvToPvfXKSNYU0qdTJK553/ouIBkRAxQsTVIRKEJsKLHkjMtRyGeSoxzFKQCszwTH6tM/UGirmzPa2esvZMp0NErGWJfMqEUaaFrupO8Eqdke37NuXG7UxtwKBgF9EWzLqr0nri8biamq/UhPLnTRH5Jib+docT2cInYbGJrbCKY3CUgof091Ba4Tqlq2qfWaS1mRXim6sAeCBpxYZd9qcOXMlb7z2LSuFK6AFrgWawIXPSLLOJ6I+MJDZrzd0XZIz5hi9lZr33livV05WNdIkWiLi98aFwJFMve3ZAoGAZxNjegOhTJ33Djdj3g80rLq4T7Uzc31GZ52jl+uY352HurnJiH1O20kBYyL8u/eb/joKSHJpnOOgswDHQceOECdoa+ahjse8ztOCC8rwzx9nishhH2V99GB8HxeBMMyMel04FsRuz9nFlEpv6U3FEnrRHDLzVidnMFGPYvd2DlUCgYABD3BFF8MryRM/N/H5Xlhfmvv+oe2Nq5ZkVF47dwSiPP1iEPGvoAHTJdK00kSrfRuwqEnsE47V0h9v8oGBmrFcelbVMpK13fWDFvt/2Vs2N/aZQpJ8JCLJo1w5NpMBvGVCGGqF5IgfUJVcwAls9iTM1JeU1FYbc+23oh+NIX339A==",
		
		//异步通知地址
		// 'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		'notify_url' => "http://www.fcc.cn/index.php/admin/alipay/notify",
		
		//同步跳转
		// 'return_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php",
           'return_url' => "http://www.fcc.cn/index.php/admin/alipay/returnfy",


		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => 
			"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmbMQ2s4A7qHT4M6nKk9ca2cuALrfHzhIREJ4R97kgVtOjgQZZTeLNqbRWmK3lvOzlBoQGT9lmcsfggCYLm1LKH1/VLlErQ247nbreBhYvofh58CF5ltv6b5yXxtVACs2RMqpLMPYFNFzs4CBoOZN21jVygWh3D23ZHvH7exrapTRMC3/PdXH6VKxPQ7znNGyDQhT85EqDkNXupcw7GDK10naiMqi7EBWSxtzU7eh+7miZqW+bPqSTO1Z3lfnIUN3a7PVD4jJQM9eTxpnGRz5PFi+hkrzfaX581ALoqnfGRaAq8xho/UyZWJ4F9AiiAFvcUhU0Tz1ITXnW39NivVeOQIDAQAB",
);