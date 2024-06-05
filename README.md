# Kubernetes Challenge

This project showcases proficiency in Kubernetes and containerization, demonstrating the ability to deploy, scale, and manage web applications efficiently in a Kubernetes environment.

---

## Table of Contents

- [Overview](#overview)
- [Project Structure](#project-structure)
- [Kubernetes Manifests (for non Helm deployment)](#kubernetes-manifests-for-non-helm-deployment)
- [Helm Chart](#helm-chart)
- [GitHub Actions Workflow](#github-actions-workflow)
- [Deployment Instructions](#deployment-instructions)
    - [Helm Installation and Usage](#helm-installation-and-usage)
    - [Kubernetes Manifests (for non Helm deployment)](#kubernetes-manifests-for-non-helm-deployment-1)
    - [GitHub Actions CI/CD Pipeline](#github-actions-cicd-pipeline)
- [Testing and Verification](#testing-and-verification)
- [Acknowledgments](#acknowledgments)

---

## Overview

The Kubernetes Challenge is a spin-off of the Cloud Resume Challenge (CRC), focusing on Kubernetes proficiency and containerization skills. It aims to highlight the ability to deploy, scale, and manage web applications in a Kubernetes environment with a streamlined approach using Helm and GitHub Actions.

---

## Project Structure

- **Helm/**: Contains Helm chart for deploying the application and database.
    - **Chart.yaml**: Metadata about the Helm chart.
    - **templates/**: Contains Kubernetes resource templates.
        - **db-connection-string.yaml**: ConfigMap for storing the database connection string.
        - **db-init-script.yaml**: ConfigMap for initializing the database schema and data.
        - **feature-toggle-config.yaml**: ConfigMap for enabling feature toggles, such as dark mode.
        - **hpa.yaml**: Horizontal Pod Autoscaler configuration for autoscaling the application based on CPU utilization.
        - **k8s-challenge-app-service.yaml**: Service configuration for exposing the application.
        - **k8s-challenge-app.yaml**: Deployment configuration for the web application.
        - **mariadb-deployment.yaml**: Deployment configuration for MariaDB.
        - **mariadb-pvc.yaml**: PersistentVolumeClaim for data persistence.
        - **mariadb-root-password.yaml**: Secret for storing the root password of the MariaDB database.
        - **mariadb-service.yaml**: Service configuration for exposing the MariaDB service.
    - **values.yaml**: Default configuration values for the Helm chart.
- **Kubernetes/**: Contains Kubernetes manifests for deploying the application and database.
    - **db-connection-string.yaml**: ConfigMap for storing the database connection string.
    - **db-init-script.yaml**: ConfigMap for initializing the database schema and data.
    - **feature-toggle-config.yaml**: ConfigMap for enabling feature toggles, such as dark mode.
    - **hpa.yaml**: Horizontal Pod Autoscaler configuration for autoscaling the application based on CPU utilization.
    - **k8s-challenge-app-service.yaml**: Service configuration for exposing the application.
    - **k8s-challenge-app.yaml**: Deployment configuration for the web application.
    - **mariadb-deployment.yaml**: Deployment configuration for MariaDB.
    - **mariadb-pvc.yaml**: PersistentVolumeClaim for data persistence.
    - **mariadb-root-password.yaml**: Secret for storing the root password of the MariaDB database.
    - **mariadb-service.yaml**: Service configuration for exposing the MariaDB service.
- **src/**: Source code files for the application.
- **Dockerfile**: Dockerfile for containerizing the application.
- **.github/workflows/deploy.yml**: GitHub Actions workflow for CI/CD automation.
- **README.md**: Project documentation.

---

## Kubernetes Manifests (for non Helm deployment)

The Kubernetes manifests provide an alternative way to deploy the application and its dependencies without using Helm. These manifests are located in the `Kubernetes/` directory and define the necessary Kubernetes resources such as Deployments, Services, ConfigMaps, and Secrets.

Each file in the `Kubernetes/` directory corresponds to a specific Kubernetes resource. For example, `deployment.yaml` defines a Deployment for the application, `service.yaml` defines a Service to expose the application, and so on.

These manifests are written in YAML and follow the Kubernetes API schema. They can be applied to a Kubernetes cluster using the `kubectl apply` command.

While using Kubernetes manifests directly provides more control and visibility into each resource, it lacks some of the conveniences of Helm such as parameterization, release management, and rollbacks. Therefore, it's recommended for users who are more comfortable with Kubernetes and prefer to manage resources manually.

---

## Helm Chart

The Helm chart simplifies the deployment and management of Kubernetes resources. It includes templates for all Kubernetes manifests and allows for parameterization through values.yaml.

---

## GitHub Actions Workflow

The GitHub Actions workflow automates the build, publish, and deployment process to GKE, ensuring an efficient CI/CD pipeline. For detailed workflow, see the [deploy.yml](.github/workflows/deploy.yml) file.

### CI/CD Pipeline Overview

- **Checkout Code**: Checks out the code from the repository.
- **Authenticate with Google Cloud**: Authenticates to Google Cloud using workload identity federation.
- **Set up Docker Buildx**: Sets up Docker Buildx for multi-platform builds.
- **Cache Docker Layers**: Caches Docker layers to speed up subsequent builds.
- **Log in to Docker Hub**: Authenticates to Docker Hub to push images.
- **Set up GKE Credentials**: Retrieves GKE credentials for kubectl.
- **Build and Push Docker Image**: Builds and pushes the Docker image to Docker Hub.
- **Deploy to GKE**: Updates the Kubernetes deployment with the new Docker image.

---

## Deployment Instructions

### Helm Installation and Usage

1. Ensure Helm is installed on your local machine.
2. Navigate to the Helm chart directory:
    ```sh
    cd Helm/
    ```
3. Package the Helm chart:
    ```sh
    helm package .
    ```
4. Install or upgrade the Helm release:
    ```sh
    helm upgrade --install k8s-challenge-app . --namespace <namespace> --create-namespace
    ```
5. Application and Database Deployment:
    - The Helm chart deploys both the application and the MariaDB database with appropriate configuration, ensuring seamless integration and scalability.

### Kubernetes Manifests (for non Helm deployment)

If you prefer not to use Helm for deployment, you can use the Kubernetes manifests directly. These are located in the `Kubernetes/` directory. Here are the steps to deploy using kubectl:

1. Set up the Kubernetes environment:
    - Ensure `kubectl` is installed and configured to interact with your Kubernetes cluster.

2. Navigate to the Kubernetes directory:
    ```sh
    cd Kubernetes/
    ```

3. Apply the Kubernetes manifests:
    - Apply the ConfigMaps:
        ```sh
        kubectl apply -f db-connection-string.yaml
        kubectl apply -f db-init-script.yaml
        kubectl apply -f feature-toggle-config.yaml
        ```
    - Apply the Deployments and Services:
        ```sh
        kubectl apply -f k8s-challenge-app.yaml
        kubectl apply -f k8s-challenge-app-service.yaml
        kubectl apply -f mariadb-deployment.yaml
        kubectl apply -f mariadb-service.yaml
        ```
    - Apply the Secret:
        ```sh
        kubectl apply -f mariadb-root-password.yaml
        ```
    - Apply the PersistentVolumeClaim:
        ```sh
        kubectl apply -f mariadb-pvc.yaml
        ```
    - Apply the Horizontal Pod Autoscaler:
        ```sh
        kubectl apply -f hpa.yaml
        ```

4. Verify the deployment:
    - Use `kubectl` commands to verify the status of the pods, services, and other resources:
        ```sh
        kubectl get pods
        kubectl get services
        ```

Remember to replace any placeholders in the Kubernetes manifests with your actual values before applying them.

### GitHub Actions CI/CD Pipeline

Ensure your GitHub repository is configured with the necessary secrets:
- `GKE_PROJECT`
- `GKE_PROJECT_NUMBER`
- `DOCKER_USERNAME`
- `DOCKER_PASSWORD`

The provided workflow file will handle the build, push, and deploy processes automatically upon pushing to the `main` branch.

### Testing and Verification

- After deployment, verify the application functionality and health probes using `kubectl` commands:
    ```sh
    kubectl get pods -n <namespace>
    kubectl get services -n <namespace>
    kubectl logs <pod-name> -n <namespace>
    ```
- Ensure the Horizontal Pod Autoscaler (HPA) is correctly scaling the application based on CPU utilization.

---

## Acknowledgments

- [Forrest Brazeal](https://forrestbrazeal.com/) for initiating the Cloud Resume Challenge.
- [KodeKloud](https://kodekloud.com/) for collaboration on Kubernetes spin-off.

---

[Challenge Details](https://cloudresumechallenge.dev/docs/extensions/kubernetes-challenge/)
