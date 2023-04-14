kubectl create namespace traefik
helm install traefik traefik/traefik --namespace=traefik --values=values.yaml
helm upgrade traefik traefik/traefik --namespace=traefik --values=values.yaml

helm install ingress-nginx ingress-nginx/ingress-nginx --namespace=ingress-nginx
helm install ingress-nginx ingress-nginx/ingress-nginx --namespace=ingress-nginx --set controller.publishService.enabled=true --set controller.service.externalTrafficPolicy=Local --set controller.service.annotations."service\.beta\.kubernetes\.io/do-loadbalancer-enable-proxy-protocol=true" --set controller.replicaCount=2 --set-string controller.config.use-proxy-protocol=true,controller.config.use-forward-headers=true,controller.config.compute-full-forward-for=true