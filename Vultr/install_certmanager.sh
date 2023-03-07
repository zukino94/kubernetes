helm repo add traefik https://helm.traefik.io/traefik
helm repo update
helm install traefik traefik/traefik --create-namespace --namespace api
kubectl get svc -n api
kubectl apply --validate=false -f https://github.com/cert-manager/cert-manager/releases/download/v1.9.1/cert-manager.yaml
kubectl apply -f Letsencrypt_issuer.yaml
kubectl apply -f certificates.yaml