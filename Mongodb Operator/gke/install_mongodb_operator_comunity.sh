helm repo add mongodb https://mongodb.github.io/helm-charts
helm repo update
helm install community-operator mongodb/community-operator --create-namespace --namespace mongodb
helm install community-operator mongodb/community-operator --set operator.watchNamespace="mongodb"
kubectl get secret mongodbserver-admin-zukino -n mongodb -o json | jq -r '.data | with_entries(.value |= @base64d)'