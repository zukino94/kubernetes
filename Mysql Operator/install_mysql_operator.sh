helm repo add mysql-operator https://mysql.github.io/mysql-operator
helm repo update
helm install my-mysql-operator mysql-operator/mysql-operator --namespace mysqlserver --create-namespace
kubectl create secret generic mypwds -n mysql-operator --from-literal=rootUser=root --from-literal=rootHost=% --from-literal=rootPassword="Zuk1n0"
helm uninstall my-mysql-operator mysql-operator/mysql-operator --namespace mysqlserver