package com.example.autella;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.InstanceIdResult;
import com.google.firebase.messaging.FirebaseMessaging;

import static android.content.ContentValues.TAG;

public class MainActivity extends AppCompatActivity {

    private Button botaoVisualizarGabaritos;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        botaoVisualizarGabaritos = (Button) findViewById(R.id.botaoVisualizarGabaritos);

        cadastrarEventos();

        FirebaseMessaging.getInstance().subscribeToTopic("all");
    }

    private void cadastrarEventos() {
        botaoVisualizarGabaritos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent troca = new Intent(MainActivity.this, VisualizarProvas.class);
                
                startActivityForResult(troca, 0);
            }
        });
    }


}